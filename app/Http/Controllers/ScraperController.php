<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Models\Bouteille;
use Illuminate\Support\Facades\DB;

class ScraperController extends Controller
{
    // public function welcome () {

    //     // $web = new \Spekulatius\PHPScraper\PHPScraper;

    //     // $web->go('https://www.saq.com/fr/produits/vin');

    //     // $test = $web->internalLinks;
        

    //     // return view('scraper.accueil', ['mot' => 'Phil scrape le site de la SAQ', 'tests' => $test]);
    //     return view('scraper.accueil', ['mot' => 'Phil scrape le site de la SAQ']);
    // }

    // public function keywords () {

    //     $web = new \Spekulatius\PHPScraper\PHPScraper;


    //     $web->go('https://www.saq.com/fr/produits/vin?product_list_limit=96&product_list_order=name_asc');

    //     $keywords = $web->contentKeywords;

    //     return view('scraper.keywords', ['keywords' => $keywords, 'mot' => 'Phil essaye de ramasser les keywords']);
    // }

    public function codes () {

        $clientCodes = new Client();
        $crawlerCodes = new Crawler();

        $reponse = $clientCodes->get('https://www.saq.com/fr/produits/vin?p=1&product_list_limit=96&product_list_order=name_asc');

        $htmlNbPages = $reponse->getBody()->getContents();

        $crawlerCodes->addHtmlContent($htmlNbPages);

        $totalItems = 0;
        $itemsParPage = 96;

        $calculNbPages = $crawlerCodes->filter('.toolbar-amount')->text();

        if(preg_match('/Résultats\s+(\d+)\s*-\s*(\d+)\s*sur\s*(\d+)/', $calculNbPages, $resultats)){
            // $premierItem = (int) $resultats[1];
            // $dernierItem = (int) $resultats[2];
            $totalItems = (int) $resultats[3];
        }

        $totalPages = ceil($totalItems / $itemsParPage);
        if (DB::table('bouteilles')->count() > 0) {

            $codesExistants = DB::table('bouteilles')->pluck('code_SAQ')->toArray();
        }
        else {

            $codesExistants = [];
        }

        for($page = 1; $page <= $totalPages; $page++){

            
            $reponse = $clientCodes->get("https://www.saq.com/fr/produits/vin?p=$page&product_list_limit=96&product_list_order=name_asc");
            $htmlCodes = $reponse->getBody()->getContents();
            $crawlerCodes->clear();
            $crawlerCodes->addHtmlContent($htmlCodes);

            $codes = $crawlerCodes->filter('.saq-code');

            foreach($codes as $code){
                $codeSAQ = $code->textContent;
                $numero = preg_replace('/[^0-9]/', '', $codeSAQ);
                if(!in_array($numero, $codesExistants)){
                    $bouteille = new Bouteille();
                    $bouteille->code_saq = $numero;
                    $bouteille->save();
                    $codesExistants[] = $numero;
                }
            }
        }

        return view('scraper.codes', ['mot' => 'Procédure complétée']);
    }

    public function liste () {
        set_time_limit(0);
        $erreurs = [];

        try{

            // if (DB::table('bouteilles')->count() > 0) {
                // Récupérer tous les codes SAQ existants dans la table "bouteilles"
                $codesExistants = DB::table('bouteilles')->pluck('code_SAQ')->toArray();
            // } else {
            //     $codesExistants = [];
            // }


            //* Les fichiers à utiliser
            // $bouteilles = Storage::json('bouteillestest3.json');
            // $urls = Storage::json('testCodes.json');
            // $urls = Storage::json('codesSAQ.json');

            //* Instanciation des Http Guzzlers
            $client_fr = new Client();
            $client_en = new Client();

            // * compteur de bouteilles traitées
            // $codesTraites = 0;

            foreach ($codesExistants as $codeSAQ) {

                $bouteille = Bouteille::where('code_SAQ', $codeSAQ)->first();
                // if(in_array($url, $codesExistants)){
                //     // on passe à la bouteille suivante
                //     continue;
                // }
                if($bouteille->est_scrape){
                    // on passe à la bouteille suivante
                    continue;
                }
                else{
                // //* Instanciation de bouteille à storer
                // $bouteille = New Bouteille();
                //* Fabrication de l'url à scraper
                $url_fr = 'https://www.saq.com/fr/' . $codeSAQ;
                $url_en = 'https://www.saq.com/en/' . $codeSAQ;

                //* Requête de la page
                $reponse_fr = $client_fr->request('GET', $url_fr);
                $reponse_en = $client_en->request('GET', $url_en);

                //* Stockage de l'information de la page
                $html_fr = $reponse_fr->getBody()->getContents();
                $html_en = $reponse_en->getBody()->getContents();

                //* Instanciation du Crawler Symphony
                $crawler_fr = new Crawler($html_fr);
                $crawler_en = new Crawler($html_en);

                //* Cibler le nom de la bouteille
                $titre_fr = $crawler_fr->filter('h1')->first()->text();
                // $titre_en = $crawler_en->filter('h1')->first()->text();

                //* Cibler le texte descriptif, si présent
                $texte_fr = $this->getTextFromCrawler($crawler_fr, '.wrapper-content-info');
                $texte_en = $this->getTextFromCrawler($crawler_en, '.wrapper-content-info');

                //* Cibler la liste d'attributs
                $listeAttributs_fr = $crawler_fr->filter('ul.list-attributs li');
                $listeAttributs_en = $crawler_en->filter('ul.list-attributs li');

                //* cibler la liste de tasting
                $listeTasting_fr = $crawler_fr->filter('ul.tasting-container li');
                $listeTasting_en = $crawler_en->filter('ul.tasting-container li');

                //* les tableaux d'attributs
                $attributs_fr = $this->extractInformation($listeAttributs_fr, "fr", false, true);
                $attributs_en = $this->extractInformation($listeAttributs_en, "en", false, true);

                //* les tableaux de tasting
                $tasting_fr = $this->extractInformation($listeTasting_fr, "fr", true, false);
                $tasting_en = $this->extractInformation($listeTasting_en, "en", true, false);

                //* les images
                $image_fr = $this->extractImageInformation($crawler_fr, $client_fr, '.MagicToolboxContainer img', 'images');
                // $image_en = $this->extractImageInformation($crawler_en, $client_en, '.MagicToolboxContainer img', 'images');

                //* les pastilles
                $pastille_fr = $this->extractImageInformation($crawler_fr, $client_fr, '.wrapper-taste-tag img', 'pastilles', true);
                $pastille_en = $this->extractImageInformation($crawler_en, $client_en, '.wrapper-taste-tag img', 'pastilles', true);

                //* le prix
                $prix = null;
                $prix = $crawler_fr->filter('.price')->first()->text();

                //* SECTION TASTING
                $bouteille->aromes_fr = $tasting_fr["Arômes"];
                $bouteille->aromes_en = $tasting_en["Aromas"];
                $bouteille->acidite_fr = $tasting_fr["Acidité"];
                $bouteille->acidite_en = $tasting_en["Acidity"];
                $bouteille->sucrosite_fr = $tasting_fr["Sucrosité"];
                $bouteille->sucrosite_en = $tasting_en["Sweetness"];
                $bouteille->corps_fr = $tasting_fr["Corps"];
                $bouteille->corps_en = $tasting_en["Body"];
                $bouteille->bouche_fr = $tasting_fr["Bouche"];
                $bouteille->bouche_en = $tasting_en["Mouthfeel"];
                $bouteille->bois_fr = $tasting_fr["Bois"];
                $bouteille->bois_en = $tasting_en["Wood"];
                $bouteille->temperature_fr = $tasting_fr["Température de service"];
                $bouteille->temperature_en = $tasting_en["Serving temperature"];
                $bouteille->millesime = $tasting_fr["Millésime dégusté"];
                $bouteille->potentiel_de_garde_fr = $tasting_fr["Potentiel de garde"];
                $bouteille->potentiel_de_garde_en = $tasting_en["Aging potential"];

                //* SECTION ATTRIBUTS
                $bouteille->pays_fr = $attributs_fr["Pays"];
                $bouteille->pays_en = $attributs_en["Country"];
                $bouteille->region_fr = $attributs_fr["Région"];
                $bouteille->region_en = $attributs_en["Region"];
                $bouteille->designation_reglementee_fr = $attributs_fr["Désignation réglementée"];
                $bouteille->designation_reglementee_en = $attributs_en["Regulated Designation"];
                $bouteille->classification_fr = $attributs_fr["Classification"] ?? null;
                $bouteille->classification_en = $attributs_en["Classification"] ?? null;
                if (isset($attributs_fr["Cépage"])) {
                    $bouteille->cepage = $attributs_fr["Cépage"] ?? null;
                } 
                elseif (isset($attributs_fr["Cépages"])) {
                    $bouteille->cepage = $attributs_fr["Cépages"] ?? null;
                }
                $bouteille->degree_alcool = $attributs_fr["Degré d'alcool"];
                $bouteille->taux_de_sucre = $attributs_fr["Taux de sucre"];
                $bouteille->couleur_fr = $attributs_fr["Couleur"];
                $bouteille->couleur_en = $attributs_en["Color"];
                $bouteille->format = $attributs_fr["Format"];
                $bouteille->producteur = $attributs_fr["Producteur"];
                $bouteille->agent_promotionnel = $attributs_fr["Agent promotionnel"];
                // $bouteille->code_SAQ = $attributs_fr["Code SAQ"];
                $bouteille->code_CUP = $attributs_fr["Code CUP"];
                $bouteille->produit_quebec_fr = $attributs_fr["Produit du Québec"];
                $bouteille->produit_quebec_en = $attributs_en["Product of Québec"];
                $bouteille->particularite_fr = $attributs_fr["Particularité"];
                $bouteille->particularite_en = $attributs_en["Special feature"];
                $bouteille->appellation_origine = $attributs_fr["Appellation d'origine"];

                //* DONNÉES SÉPARÉES
                $bouteille->nom = $titre_fr;
                $bouteille->image_bouteille = $image_fr["url"];
                $bouteille->image_bouteille_alt = $image_fr["alt"] ?? null;
                $bouteille->prix = $prix;
                $bouteille->image_pastille = $pastille_fr["url"] ?? null;
                $bouteille->image_pastille_alt = $pastille_fr["alt"] ?? null;
                $bouteille->description_fr = $texte_fr;
                $bouteille->description_en = $texte_en;

                $bouteille->est_scrape = true;
                $bouteille->save();

                // $codesTraites++;
                // $codesExistants[] = $url;
                // echo "codes traités:";
                // var_dump($codesTraites);
                //* Une petite pause après beaucoup d'effort!
                sleep(1);
                } //? la boucle sur les codes SAQ fin du else
            }
        }
        catch(\Exception $e){

            $erreurs[] = "Erreur lors du traitement du code SAQ $codeSAQ : " . $e->getMessage();
            Log::error("Erreur lors du traitement du code SAQ $codeSAQ : " . $e->getMessage());
        }

        $afficherBouteilles = Bouteille::all();
        $nbBouteillesTraites = DB::table('bouteilles')->where('est_scrape', true)->count();
        return view('scraper.liste', [
            'bouteilles' => $afficherBouteilles,
            'lang' => "fr",
            'erreurs' => $erreurs,
            'codesTraites' => $nbBouteillesTraites,
        ]);
    }

        /**
         * Récupérateur de texte de description
         * @param $crawler objet crawler symphony
         * @param $selector la classe à cibler par le crawler
         * @return $texte le texte trouvé dans la classe ciblée, null le cas échéant
         */
        function getTextFromCrawler($crawler, $selecteur) {

            $texte = $crawler->filter($selecteur)->first();

            if ($texte->count() > 0) {

                return $texte->text();
            }

            else {

                return null;
            }
        }

        /**
         * Récupérateur d'informations
         * @param $elements la liste extraite de la page 
         * @param $lang la langue à traiter, pour ajouter les clés manquantes avec la valeur nulle
         * @param $isTasting booléen servant à vérifier si on traite les informations de tasting
         * @param $isAttributs booléen servant à vérifier si on traite les informations d'attributs
         * @return $information tableau associatif avec les valeurs, ou les clés avec une valeur nulle pour chaque
         */
        function extractInformation($elements, $lang, $isTasting = false, $isAttributs = false) {

            $information = [];
            $ajoutCle = [];
            
            if($elements->count() > 0){

                $elements->each(function (Crawler $element) use (&$information) {

                    $nom = $element->filter('span')->text();
                    $valeur = $element->filter('strong')->text();
            
                    $information[$nom] = $valeur;
                });
            }

            if($isAttributs){
                if($lang == "fr"){
                    $ajoutCle = [
                        "Région",
                        "Appellation d'origine",
                        "Désignation réglementée",
                        "Classification",
                        "Cépage",
                        "Taux de sucre",
                        "Particularité",
                        "Agent promotionnel",
                        "Code CUP",
                        "Produit du Québec"
                    ];
                }
                elseif($lang == "en"){
                    $ajoutCle = [
                        "Region",
                        "Designation of origin",
                        "Regulated Designation",
                        "Classification",
                        "Grape variety",
                        "Sugar content",
                        "Special feature",
                        "Promoting agent",
                        "UPC code",
                        "Product of Québec",
                    ];
                }
                foreach($ajoutCle as $cle){
                    if(!array_key_exists($cle, $information)){
                        $information[$cle] = null;
                    }
                }
            }

            if($isTasting){
                if($lang == "fr"){
                    $ajoutCle = [
                        "Arômes",
                        "Acidité",
                        "Sucrosité",
                        "Corps",
                        "Bouche",
                        "Bois",
                        "Température de service",
                        "Millésime dégusté",
                        "Potentiel de garde"
                    ];
                }
                elseif($lang == "en"){
                    $ajoutCle = [
                        "Aromas",
                        "Acidity",
                        "Sweetness",
                        "Body",
                        "Mouthfeel",
                        "Wood",
                        "Serving temperature",
                        "Vintage tasted",
                        "Aging potential"
                    ];
                }
                foreach($ajoutCle as $cle){
                    if(!array_key_exists($cle, $information)){
                        $information[$cle] = null;
                    }
                }
            }
        
            return $information;
        }

        /**
         * Récupérateur d'images et de pastilles
         * @param $crawler objet crawler symphony
         * @param $client instance de HTTP Guzzler
         * @param $selector la classe à cibler par le crawler
         * @param $folder le dossier cible pour storer l'image téléchargée
         * @param $includeTitle valeur booléenne pour confirmer si on doit extraire l'attribut title ou pas
         * @return $image tableau associatif contenant le nom de l'image, le texte alternatif et le titre, selon $includeTitle
         */
        function extractImageInformation($crawler, $client, $selector, $folder, $includeTitle = false) {
            $image = null;
        
            $imageRaw = $crawler->filter($selector)->first();
        
            if ($imageRaw->count() > 0) {
                $imageUrl = $imageRaw->attr('src');
                $imageAlt = $imageRaw->attr('alt');
                $imageTitle = $includeTitle ? $imageRaw->attr('title') : null;
        
                $imageDownload = strtok($imageUrl, '?');
        
                $responseImage = $client->request('GET', $imageDownload);
        
                if ($responseImage->getStatusCode() === 200) {
                    $imageContent = $responseImage->getBody()->getContents();
                    $imageUrlClean = parse_url($imageUrl, PHP_URL_PATH);
                    $imageFilename = basename($imageUrlClean);
        
                    $folderName = $folder;
        
                    if (!Storage::disk('local')->exists($folderName)) {
                        Storage::disk('local')->makeDirectory($folderName);
                    }
        
                    if (!Storage::disk('local')->exists($folderName . '/' . $imageFilename)) {
                        Storage::disk('local')->put($folderName . '/' . $imageFilename, $imageContent);
                    }
        
                    $image["url"] = $imageFilename;
                    $image["alt"] = $imageAlt;
                    if ($includeTitle) {
                        $image["title"] = $imageTitle;
                    }
                }
            }
        
            return $image;
        }
}
