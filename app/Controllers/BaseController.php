<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: 
        $this->session = \Config\Services::session();
    }
    
    public function displayResults(...$dd)
    {
        foreach ($dd as $debug):
            echo '<pre>';
            var_dump($debug);
            echo '</pre>';
        endforeach;
        exit();
    }

    /**
     * @return string
     * Generateur des identifiants de tables
     */
    public function generateIdentifiant()
    {
        $aleatoire = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
        $code_value = substr(str_shuffle(str_repeat($aleatoire, mt_rand(14, 25))), 0, 14);
        return date('Ymd') . time() . $code_value;
    }

    public function getUserAgentInfo()
    {
        $agent = $this->request->getUserAgent();
        $os_platform = $agent->getPlatform();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return ($os_platform . ' on ' . $currentAgent);
    }

    public function getClientIpAddress()
    {

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            //To Check IP is Pass From Proxy
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            //To Check IP is Pass From remote
            return $_SERVER["REMOTE_ADDR"];
        } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            //Checking IP From Shared Internet
            return $_SERVER["HTTP_CLIENT_IP"];
        } else {
            return false;
        }
    }

    public function getClientLocation()
    {

        //$ipclientRemote =  $this->getClientIpAddress();

        //$locationJson = file_get_contents('http://ip-api.com/json/'.$ipclientRemote);
        //$details_locationJson = json_decode($locationJson);

        //if (! empty($details_locationJson->status == "success")) {
        //$realIP = $details_locationJson->query;
        //$ipinfo_url_token = "ipinfo.io/41.243.2.29?token=b4d4b25be34eb4";
        //$ipinfo_url = file_get_contents("http://ipinfo.io/41.243.2.29?token=b4d4b25be34eb4");
        //$locationfromip = json_decode($ipinfo_url);

        $locipdata = false;
        // Création d'un gestionnaire cURL41.243.2.29
        $ch = curl_init("http://ipinfo.io/");

        // Exécution
        curl_exec($ch);

        // Vérification du code d'état HTTP
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:
                    $locdata = curl_getinfo($ch);
                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        }
        // Close handle
        curl_close($ch);

        if (!empty($locipdata)) {
            $userDataLocation = array(
                'ipuser' => $locipdata->ip,
                'fai' => $locipdata->org,
                'host' => $locipdata->hostname,
                'city' => $locipdata->city,
                'state' => $locipdata->region,
                'country' => $locipdata->country,
                'timezone' => $locipdata->timezone,
                'maps' => $locipdata->loc,
                'latitude' => substr(strstr($locipdata->loc, ','), 1),
                'longitude' => strstr($locipdata->loc, ',', true),
            );
            return $userDataLocation;
        }
        //}
        return false;
    }
    public function convertDateFormat($date, $type, $format)
    {
        $valueDate = "";
        if ($type == 'database') {
            $valueDate = date($format, strtotime(str_replace('/', '-', $date)));
        } else {
            $valueDate = utf8_encode(strftime($format, strtotime($date)));
        }
        return $valueDate;
    }
    public function checkStrongPassword($mdp)
    {
        // $mdp le mot de passe passé en paramètre
        // On récupère la longueur du mot de passe
        $longueur = strlen($mdp);
        $point_maj = 0;
        $point_caracteres = 0;
        $point_min = 0;
        $point = 0;
        $point_chiffre = 0;

        // On fait une boucle pour lire chaque lettre
        for ($i = 0; $i < $longueur; $i++) {

            // On sélectionne une à une chaque lettre
            // $i étant à 0 lors du premier passage de la boucle
            $lettre = $mdp[$i];
            $point = 0;
            if ($lettre >= 'a' && $lettre <= 'z') {
                // On ajoute 1 point pour une minuscule
                $point = $point + 1;

                // On rajoute le bonus pour une minuscule
                $point_min = 1;
            } else if ($lettre >= 'A' && $lettre <= 'Z') {
                // On ajoute 2 points pour une majuscule
                $point = $point + 2;
                // On rajoute le bonus pour une majuscule
                $point_maj = 2;
            } else if ($lettre >= '0' && $lettre <= '9') {
                // On ajoute 3 points pour un chiffre
                $point = $point + 3;
                // On rajoute le bonus pour un chiffre
                $point_chiffre = 3;
            } else {
                // On ajoute 5 points pour un caractère autre
                $point = $point + 5;
                // On rajoute le bonus pour un caractère autre
                $point_caracteres = 5;
            }
        }
        // Calcul du coefficient points/longueur
        $etape1 = $point / $longueur;

        // Calcul du coefficient de la diversité des types de caractères...
        $etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;

        // Multiplication du coefficient de diversité avec celui de la longueur
        $resultat = $etape1 * $etape2;

        // Multiplication du résultat par la longueur de la chaîne
        $final = $resultat * $longueur;

        return $final;
    }

    public function remove_string_accent($str)
    {
        $url = $str;
        $url = preg_replace('#Ç#', 'C', $url);
        $url = preg_replace('#ç#', 'c', $url);
        $url = preg_replace('#è|é|ê|ë#', 'e', $url);
        $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
        $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
        $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
        $url = preg_replace('#ì|í|î|ï#', 'i', $url);
        $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
        $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
        $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
        $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
        $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
        $url = preg_replace('#ý|ÿ#', 'y', $url);
        $url = preg_replace('#Ý#', 'Y', $url);
        return ($url);
    }
}
