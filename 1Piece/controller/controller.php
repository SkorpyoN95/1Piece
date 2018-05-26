<?php
/**
 * @author Łukasz Socha <kontakt@lukasz-socha.pl>
 * @version: 1.0
 * @license http://www.gnu.org/copyleft/lesser.html
 */
 
/**
 * This class includes methods for controllers.
 *
 * @abstract
 */
abstract class Controller{
 
    /**
     * It redirects URL.
     *
     * @param string $url URL to redirect
     *
     * @return void
     */
    public function redirect($url) {
        //header("Location: ".$url);
		echo "<script>window.location.href='".$url."';</script>";
    }
	
	public function safeData($data)
	{
		$safe_data = strip_tags($data);
		return $safe_data;
	}
	
	public function loadController($name, $path='controller/') {
        $path=$path.$name.'Controller.php';
        $name=$name.'Controller';
        try {
            if(is_file($path)) {
                require_once $path;
                $ob=new $name();
            } else {
                throw new Exception('Can not open controller '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }
    /**
     * It loads the object with the view.
     *
     * @param string $name name class with the class
     * @param string $path pathway to the file with the class
     *
     * @return object
     */
    public function loadView($name, $path='view/') {
        $path=$path.$name.'View.php';
        $name=$name.'View';
        try {
            if(is_file($path)) {
                require_once $path;
                $ob=new $name();
            } else {
                throw new Exception('Can not open view '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }
    /**
     * It loads the object with the model.
     *
     * @param string $name name class with the class
     * @param string $path pathway to the file with the class
     *
     * @return object
     */
    public function loadModel($name, $path='model/') {
        $path=$path.$name.'Model.php';
        $name=$name.'Model';
        try {
            if(is_file($path)) {
                require_once $path;
                $ob=new $name();
            } else {
                throw new Exception('Can not open model '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }
}