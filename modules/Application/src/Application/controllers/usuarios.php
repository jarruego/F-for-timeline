<?php
include_once (__DIR__ . '/../../filterForm.php');
include_once (__DIR__ . '/../../validate.php');    

if(!isset($action))
    $action = 'select';

switch ($action)
{
    case 'insert':
        if ($_POST)
        {
            include_once (__DIR__ . '/../../forms/usuariosForm.php');      
            //filtro y valido datos a insertar
            $postfilter = filterForm($_POST, $usuarios_form);     
            $validate = validate($postfilter, $usuarios_form);                        
            if($validate['valid'])
            {
                //hidrato la entity para no grabar sólo lo que quiero
                $data_usuario = array (
                    'name'=>$postfilter['name'],
                    'email'=>$postfilter['email'],
                    'password'=>$postfilter['password']
                );
                // Guardar en un archivo separado por pipes
                $data_usuarios = implode ("|",$data_usuario);
                $data_usuarios.="\n";
                $filename = $_SERVER['DOCUMENT_ROOT']."/usuarios.txt";
                file_put_contents($filename, $data_usuarios, FILE_APPEND);
                //volvemos al select
                header('Location: /usuarios/select');                 
            }
        }     
        else 
        {
            // Dibujamos formulario de insert
            include_once (__DIR__ . '/../../forms/usuariosForm.php');
            include_once (__DIR__ . '/../../drawForm.php');            
            echo drawForm($usuarios_form, '/usuarios/insert', null);
        }
    break;
    case 'update':
        if($_POST)
        {
            include_once (__DIR__ . '/../../forms/usuariosForm.php');
            //Validamos datos a modificar
            $postfilter = filterForm($_POST, $usuarios_form);     
            $validate = validate($postfilter, $usuarios_form);                        
            if($validate['valid']) {
                //capturamos el id de usuario a modificar
				$id = $postfilter['id'];				
                //hidrato la entity para no grabar sólo lo que quiero
                $data_usuario = array (
                    'name'=>$postfilter['name'],
                    'email'=>$postfilter['email'],
                    'password'=>$postfilter['password']
                );
                $data_usuarios = implode ("|", $data_usuario);
                $filename = $_SERVER['DOCUMENT_ROOT']."/usuarios.txt";
                //recogemos los datos de usuario del fichero en un array
				$usuarios = file_get_contents($filename);
				$usuarios = explode("\n", $usuarios);
                //nos situamos en el array/fila del 'id' y lo modificamos
				$usuarios[$id] = $data_usuarios;        
                //guardamos los datos en el fichero
				$data_usuarios = implode("\n", $usuarios);
				file_put_contents($filename, $data_usuarios);
                //volvemos al select
				header('Location: /usuarios/select');   
            }
        }
        else 
        {
            // Leer el archivo de texto en un string
            $filename = $_SERVER['DOCUMENT_ROOT']."/usuarios.txt";
            $usuarios = file_get_contents($filename);
            // Obtener un array desde el string
            $usuarios = explode("\n", $usuarios);
            // Tomar el usuario ID
            // Separar el usuario por pipes para tener una array
            $usuario = explode("|", $usuarios[$data[4]]);
            //Hidratamos la entity incluyendo el id en un campo oculto            
            $data_usuario = array (
                    'id' =>$data[4],
                    'name'=>$usuario[0],
                    'email'=>$usuario[1],
                    'password'=>$usuario[2]
            );
                        
            include_once (__DIR__ . '/../../forms/usuariosForm.php');
            include_once (__DIR__ . '/../../drawForm.php');            
            // Dibujar el formulario con los datos del usuario
            echo drawForm($usuarios_form,  '/usuarios/update', $data_usuario);          
        }       
    break;
    case 'delete':
		if ($_POST) {
            include_once (__DIR__ . '/../../forms/usuariosForm.php');
            include_once (__DIR__ . '/../../forms/confirmForm.php');
			//Recojo y filtro el POST
            $postfilter = filterForm($_POST, $confirm_form);     
            $validate = validate($postfilter, $confirm_form);
			if ($postfilter['si'] == "Si") { 
                //recojo el id a borrar de los datos del formulario de confirmación
				$id = $postfilter['id'];
                //Guardamos todos los datos del fichero a tratar en un array
                $filename = $_SERVER['DOCUMENT_ROOT']."/usuarios.txt";
				$usuarios = file_get_contents($filename);
				$usuarios = explode("\n", $usuarios);
                //eliminamos el elemento del array correspondiente al usuario a borrar
				unset($usuarios[$id]);
                //guardamos el nuevo array en el fichero
				$usuarios = implode("\n", $usuarios);
				file_put_contents($filename, $usuarios);
			} 
            //volvemos al select
			header('Location: /usuarios/select');                 
		} else {
            include_once (__DIR__ . '/../../forms/confirmForm.php');
            include_once (__DIR__ . '/../../drawForm.php');            
			// dibuja el formulario de confirmación
            echo drawForm($confirm_form, '/usuarios/delete', array('id' => $data[4]));
		}
		break;
    default:
    case 'select':
        // Leer del archivo de texto todos los usuarios en un string
        $filename = $_SERVER['DOCUMENT_ROOT']."/usuarios.txt";
        $data = file_get_contents($filename);
        // Separar por saltos de linea y guardar en un array
        $data = explode("\n", $data);
        echo "<a href=\"/usuarios/insert\">Insert</a>";
        echo "<table border=1>";
            foreach ($data as $key => $fila)
            {
                // Separar por pipes la fila
                $columnas = explode("|", $fila);
                echo "<tr>";
                foreach ($columnas as $key2 => $value)
                {                
                    echo "<td>";
                        echo $value;
                    echo "</td>";
                }
                echo "<td>";
                        echo "<a href=\"/usuarios/update/id/".$key."\">Update</a> | ";
                        echo "<a href=\"/usuarios/delete/id/".$key."\">Delete</a>";
                    echo "</td>";
                echo "</tr>";
            }
        echo "</table>";
    break;
}


