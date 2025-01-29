<?php

abstract class CoreModel
{

  private $_engine = DB_ENGINE;
  private $_host = DB_HOST;
  private $_dbname = DB_NAME;
  private $_charset = DB_CHARSET;
  private $_dbuser = DB_USER;
  private $_dbpwd = DB_PWD;

  private $_db;


  public function __construct()
  {
    $this->connect();
  }

  /**
   * database connexion
   * 
   * @return void
   * 
   */
  private function connect(): void
  {
    try {
      $dsn = $this->_engine . ':host=' . $this->_host . ';dbname=' . $this->_dbname . ';charset=' . $this->_charset;
      $this->_db = new PDO($dsn, $this->_dbuser, $this->_dbpwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    } catch (PDOException $e) {
      // 
      switch ($e->getCode()) {
        case 1045:
          $message = "Erreur de connexion : identifiant ou mot de passe incorrect.";
          break;
        case 2002:
          $message = "Erreur de connexion : impossible de se connecter au serveur de base de données.";
          break;
        case 1049:
          $message = "Erreur de connexion : la base de données spécifiée est introuvable.";
          break;
        default:
          $message = "Erreur de connexion à la base de données : " . $e->getMessage();
          break;
      }

      header("Location: index.php&_err=" . urlencode($message));
      exit();
    }
  }

  /**
   * _db Getter , PDO return
   * 
   * @return PDO
   * 
   */
  protected function getDb(): PDO
  {
    return $this->_db;
  }
}
