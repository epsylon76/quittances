<?php
//ENTER THE RELEVANT INFO BELOW
$time=date('Y-m-d-H\h-i\m');
$mysqlDatabaseName ='quittances';
$mysqlUserName ='epsylon';
$mysqlPassword ='alpha1987';
$mysqlHostName ='localhost';
$mysqlExportPath ='base-backup/sauv'.$time.'.sql';
//DO NOT EDIT BELOW THIS LINE
//Export the database and output the status to the page
$command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ./' .$mysqlExportPath;
exec($command);

$dir = "./base-backup";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
  $files[] = $filename;
}

foreach($files as $fichier)
{
  $datefichier=substr($fichier, 4, -12);
  if($datefichier!="")
  {
    echo $datefichier;
    echo '<br>';
    if($datefichier<DATE('Y-m-d'))
    {
      echo "date inferieure";
      unlink('./base-backup/'.$fichier);
    }
  }
}
sleep(10);

$the_folder = './';
$zip_file_name = 'sauvegarde.zip';

class FlxZipArchive extends ZipArchive {
        /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
    public function addDir($location, $name) {
        $this->addEmptyDir($name);
         $this->addDirDo($location, $name);
     } // EO addDir;

        /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';         $location .= '/';
      // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))    {
            if ($file == '.' || $file == '..') continue;
          // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    }
}

$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE)    {
    $za->addDir($the_folder, basename($the_folder)); $za->close();
}
else  { echo 'Could not create a zip archive';}

  header('Content-Type: application/zip');
  header("Content-Disposition: attachment; filename='sauvegarde.zip'");
  header('Content-Length: ' . filesize($zip_file_name));
  header("Location: sauvegarde.zip");
