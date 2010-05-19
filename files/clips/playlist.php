<?php
define('DS', DIRECTORY_SEPARATOR);
$folder = (isset($_REQUEST['folder'])) ? $_REQUEST['folder'] : "";
$thumbfolder = ($folder) ? $folder."/" : "";
function files($path, $filter = '.', $recurse = false, $fullpath = false, $exclude = array('.svn', 'CVS', 'php'), $include = array('flv','mp4','swf','3gp','mp3','rbs'))
{
	// Initialize variables
	$arr = array ();

	// Is the path a folder?
	if (!is_dir($path)) {
		?>
		<script language="javascript" type="text/javascript">alert('Path is not a folder <?php echo $path; ?>'); </script>
		<?php
		return false;
	}

	// read the source directory
	$handle = opendir($path);
	while (($file = readdir($handle)) !== false)
	{
		$dir = $path.DS.$file;
		$isDir = is_dir($dir);
		if (($file != '.') && ($file != '..') && (!in_array($file, $exclude))) {
			if ($isDir) {
				if ($recurse) {
						if (is_integer($recurse)) {
							$recurse--;
						}
						$arr2 = files($dir, $filter, $recurse, $fullpath);
						$arr = array_merge($arr, $arr2);
					}
				} else {
	
					if (preg_match("/$filter/", $file)) {
						$path_parts = pathinfo($path.DS.$file);
						if(in_array($path_parts['extension'], $include)){
							if ($fullpath) {
								$arr[] = $path.DS.$file;
							} else {
								$arr[] = $file;
							}
						}				
				}
			}
		}
	}
	//closedir($handle);

	//asort($arr);
	return $arr;
}
$path = dirname(__FILE__);
$files = files($path.DS.$folder);

$url = dirname($_SERVER['REQUEST_URI']);

?>
<playlist version="1" xmlns="http://xspf.org/ns/0/">
  <title>CG Playlist</title>
  <trackList>
		<?php
		foreach($files as $f){
			if(file_exists($path.DS.$folder.DS."thumbnail".DS.$f.".jpg")){
				 $img =  "$url/{$thumbfolder}thumbnail/$f.jpg"; 
			}elseif(file_exists($path.DS.$folder.DS."thumbnail".DS.$f.".gif")){
				  $img =  "$url/{$thumbfolder}thumbnail/$f.gif"; 
			} else  $img =  "";
			?>
			<track>
			  <title><?php echo $f; ?></title>
			  <location><?php echo "$url/$folder/$f";?></location>
			  <image><?php echo $img; ?></image>
			</track>
			<?php
		}
		?>
  </trackList>
</playlist>