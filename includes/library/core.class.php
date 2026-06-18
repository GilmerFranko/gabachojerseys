<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo ayudará a cargar archivos y evitar algunas lineas de código
 *
 *
 */

final class Core
{
  /**
   * Módulo actual
   *
   * @var string
   */
  public static $sModule = 'core';

  /**
   * Sección actual
   *
   * @var string
   */
  public static $sSection = 'posts';

  /**
   * Config
   *
   * @var array
   */
  private static $aConfig = array();

  /**
   * Modelos cargados
   *
   * @var objects
   */
  public static $oModels = array();


  /**
   * Establecer módulo
   */
  public static function setModule($sModule, $sSection, $config)
  {
    self::$sModule = $sModule;
    //
    self::$sSection = $sSection;
    //
    self::$aConfig = $config;
  }

  /**
   * Cargar controlador
   */
  public static function controller($sController = 'index', $sModule = '')
  {
    $sFile = BG_MODS . (!empty($sModule) ? $sModule : self::$sModule) . DS . 'controller' . DS . $sController . '.php';

    return self::file($sFile);
  }

  /**
   * Cargar modelo
   */
  public static function model($sModel, $sModule = '')
  {
    $sFile = self::file(BG_MODS . (($sModule) ? $sModule : self::$sModule) . DS . 'model' . DS . $sModel . '.class.php');

    if ($sFile)
    {
      /* Guarda el hash del archivo */
      $sHash = md5($sModel);

      /**
       * Si ya se ha incluido con anterioridad este modelo, retorna la
       * instancia de la clase pre-almacenada para ahorrar recursos.
       */
      if (isset(self::$oModels[$sHash]))
      {
        return self::$oModels[$sHash];
      }

      /* Incluye el archivo */
      require $sFile;

      /* Instancía la clase */
      self::$oModels[$sHash] = new $sModel();

      /**
       * Guardar en la sesion los
       * modelos utilizados por cada carga.
       * Solo en modo debug
       **/
      if (isset($_SESSION['debug_mode']) and $_SESSION['debug_mode'] and !isset($_POST['ajax']))
      {
        $_SESSION['models_used'][] = ($sModel);
      }

      /* Retornar Modelo */
      return self::$oModels[$sHash];
    }
  }
  /**
   * Cargar plantilla
   */
  public static function view($sTemplate, $sModule = '', $alternative = false)
  {
    $sFile = BG_MODS . (($sModule) ? $sModule : self::$sModule) . DS . 'view' . DS . $sTemplate . '.html.php';

    return self::file($sFile, $alternative);
  }

  /**
   * Cargar Archivo
   */
  public static function file($sFile, $alternative = false)
  {
    if (file_exists($sFile))
    {
      return $sFile;
    }
    else
    {
      if ($alternative == false)
      {
        echo 'Lo sentimos el archivo <strong>' . $sFile . '</strong> no fue localizado.';
        exit;
      }
      else
      {
        $alternative = is_string($alternative) ? $alternative : 'index';
        $section = isset($_GET['section']) ? stripslashes($_GET['section']) : 'index';
        //
        return self::view($alternative, '', $section);
      }
    }

    return false;
  }

  /**
   * Configs
   */
  public static function config($sName)
  {
    if (isset(self::$aConfig[$sName]))
    {
      return self::$aConfig[$sName];
    }

    exit('Falta la variable: ' . $sName);
  }

  // En tu archivo Core.php
  public static function vite($entry, $baseUrl)
  {
    // Cambiar a false cuando subas el proyecto a producción
    $isDev = $_ENV['DEVELOPMENT'];
    if ($isDev === true)
    {
      // En desarrollo, apuntamos al servidor local de Vite
      $path = ($entry === 'public') ? 'static/js/public-entry.js' : 'static/js/admin-entry.js';
      return '
                <script type="module" src="http://localhost:5173/@vite/client"></script>
                <script type="module" src="http://localhost:5173/' . $path . '"></script>
            ';
    }

    else
    {
      // EN PRODUCCIÓN: Leemos el manifest generado por Vite
      // Ajusta esta ruta a donde se ubica físicamente tu manifest.json desde este archivo PHP
      $manifestPath = BG_DIR . '/static/dist/.vite/manifest.json';
      if (!file_exists($manifestPath))
      {
        return '';
      }

      $manifest = json_decode(file_get_contents($manifestPath), true);

      // Buscamos la clave en el JSON (ej: "static/js/public-entry.js")
      $entryKey = ($entry === 'public') ? 'static/js/public-entry.js' : 'static/js/admin-entry.js';

      if (!isset($manifest[$entryKey]))
      {
        return "";
      }

      $html = '';
      $fileData = $manifest[$entryKey];

      // 1. Si el archivo tiene CSS asociado, imprimimos sus etiquetas <link>
      if (isset($fileData['css']))
      {
        foreach ($fileData['css'] as $cssFile)
        {
          $html .= '<link rel="stylesheet" href="' . $baseUrl . '/static/dist/' . $cssFile . '">';
        }
      }

      // 2. Imprimimos la etiqueta <script> del JS principal con su hash
      $html .= '<script type="module" src="' . $baseUrl . '/static/dist/' . $fileData['file'] . '" defer></script>';

      return $html;
    }
  }
}
