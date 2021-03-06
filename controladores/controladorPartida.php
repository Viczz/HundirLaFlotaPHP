<?php
require_once("./modelos/dbPartidas.php");


class Partida extends dbPartidas
{
    
public function __construct(){
   
}

public function unirseAPartida($idPartida,$idUsuario){
    return $this->unirseAPartidaDB($idPartida,$idUsuario);
}
public function handlerCasilla($casilla,$idPartida){

    

    $datos = explode('-',$casilla);
    $letra = $datos[0];
    $numero =$datos[1];
    $idUsuario = $datos[2];

    if(isset($_SESSION['direccion'])){
        $direccion = $_SESSION['direccion'];
    }
    unset($estadoPartida);
    $estadoPartida = $this->devolverEstadoPartida($idPartida);

    switch($estadoPartida){
        case 1: switch($this->ultimoBarcoInsertado($idPartida,$_SESSION['idUsuario'])){
                    case "Portaviones": 
                                        if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(4,$direccion,$letra,$numero,$idUsuario,$idPartida,"Acorazado");
                                            $this->mostrarPartida($idPartida);
                                            
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                                       
                    case "Acorazado": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,$direccion,$letra,$numero,$idUsuario,$idPartida,"Crucero1");
                                        $this->mostrarPartida($idPartida);
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Crucero1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,$direccion,$letra,$numero,$idUsuario,$idPartida,"Crucero2");
                                        $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;
                    case "Crucero2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor1");
                                            $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;

                    case "Destructor1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                         $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor2");
                                         $this->mostrarPartida($idPartida);
                                        }
                                        else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                            break;
                    case "Destructor2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor3");
                                            $this->cambiarEstadoPartida($idPartida,2);
                                            $this->mostrarPartida($idPartida);
                                            
                                        }else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Destructor3": 
                                        $this->mostrarPartida($idPartida);
                                        break;
                    case false: $this->introducirBarco(5,$direccion,$letra,$numero,$idUsuario,$idPartida,"Portaviones");
                                 $this->mostrarPartida($idPartida);

                                        break;
                }
        
                
                break;

        case 2: switch($this->ultimoBarcoInsertado($idPartida,$_SESSION['idUsuario'])){
                    case "Portaviones": 
                                        if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(4,$direccion,$letra,$numero,$idUsuario,$idPartida,"Acorazado");
                                            $this->mostrarPartida($idPartida);
                                            
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                                       
                    case "Acorazado": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,$direccion,$letra,$numero,$idUsuario,$idPartida,"Crucero1");
                                        $this->mostrarPartida($idPartida);
                                        } else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Crucero1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                        $this->introducirBarco(3,$direccion,$letra,$numero,$idUsuario,$idPartida,"Crucero2");
                                        $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;
                    case "Crucero2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor1");
                                            $this->mostrarPartida($idPartida);
                                    } else{
                                        $this->mostrarPartida($idPartida);
                                    }
                                        break;

                    case "Destructor1": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                         $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor2");
                                         $this->mostrarPartida($idPartida);
                                        }
                                        else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                            break;
                    case "Destructor2": if($this->comprobarCasilla($letra,$numero,$idUsuario,$idPartida)){
                                            $this->introducirBarco(2,$direccion,$letra,$numero,$idUsuario,$idPartida,"Destructor3");
                                            $this->cambiarEstadoPartida($idPartida,4);
                                            $this->mostrarPartida($idPartida);
                                        }else{
                                            $this->mostrarPartida($idPartida);
                                        }
                                        break;
                    case "Destructor3": 
                                        $this->mostrarPartida($idPartida);
                                        break;
                    case false: $this->introducirBarco(5,$direccion,$letra,$numero,$idUsuario,$idPartida,"Portaviones");
                                 $this->mostrarPartida($idPartida);

                                        break;
                }
                break;
    case 4:     if($this->atacarCasilla($letra,$numero,$idUsuario,$idPartida)){
                    if(($ganador=$this->comprobarGanador($idPartida))!==false){
                        $this->cambiarEstadoPartida($idPartida,6);
                        $this->mostrarPartida($idPartida);
                    } else{
                        $this->mostrarPartida($idPartida);
                    }
                    
                } else{
                    $this->cambiarEstadoPartida($idPartida,5);
                    $this->mostrarPartida($idPartida);
                }
               
                break;
    case 5:     if($this->atacarCasilla($letra,$numero,$idUsuario,$idPartida)){
                    if(($ganador=$this->comprobarGanador($idPartida))!==false){
                        $this->cambiarEstadoPartida($idPartida,7);
                        $this->mostrarPartida($idPartida);
                    } else{
                        $this->mostrarPartida($idPartida);
                    }
                } else{
                    $this->cambiarEstadoPartida($idPartida,4);
                    $this->mostrarPartida($idPartida);
                }
               
                break;

    }
}
public function mostrarPartida($idPartida){
    
    unset($tableros);
    $tableros = $this->mostrarTableros($idPartida);    
    $usuario = $_SESSION['idUsuario'];
    $estado = $this->devolverEstadoPartida($idPartida);
    $host = $this->devolverHostPartida($idPartida);
    $_SESSION['partida'] = $idPartida;
    $numeros = [1,2,3,4,5,6,7,8,9,10];
    $filas = [1,2,3,4,5,6,7,8,9,10];
    $columnas = [1,2,3,4,5,6,7,8,9,10];

    
    switch($estado){
        case 1: $mensaje;
                 switch($this->ultimoBarcoInsertado($idPartida,$usuario)){
                        case "Portaviones": $mensaje = "Barcos a colocar: 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                        case "Acorazado":$mensaje = "Barcos a colocar: 2 Cruceros y 3 Destructores.";
                                            break;
                        case "Crucero1": $mensaje = "Barcos a colocar: 1 Crucero y 3 Destructores.";
                                            break;
                        case "Crucero2": $mensaje = "Barcos a colocar: 3 Destructores.";
                                            break;
                        case "Destructor1": $mensaje = "Barcos a colocar: 2 Destructores.";
                                            break;
                        case "Destructor2": $mensaje = "Barcos a colocar: 1 Destructor.";
                                            break;
                        case "Destructor3": $mensaje = "Espera hasta que el rival coloque los barcos.";
                                            break;
                        case false: $mensaje = "Barcos a colocar:1 Portaviones, 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                }
                $mensajeContrincante = "Espera a que el HOST coloque sus barcos.";
                include "./vistas/mostrarPartida.php";
                break;
        case 2: $mensaje;
                switch($this->ultimoBarcoInsertado($idPartida,$usuario)){
                        case "Portaviones": $mensaje = "Barcos a colocar: 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                        case "Acorazado":$mensaje = "Barcos a colocar: 2 Cruceros y 3 Destructores.";
                                            break;
                        case "Crucero1": $mensaje = "Barcos a colocar: 1 Crucero y 3 Destructores.";
                                            break;
                        case "Crucero2": $mensaje = "Barcos a colocar: 3 Destructores.";
                                            break;
                        case "Destructor1": $mensaje = "Barcos a colocar: 2 Destructores.";
                                            break;
                        case "Destructor2": $mensaje = "Barcos a colocar: 1 Destructor.";
                                            break;
                        case "Destructor3": $mensaje = "Espera hasta que el rival coloque los barcos.";
                                            break;
                        case false: $mensaje = "Barcos a colocar:1 Portaviones, 1 Acorazado,2 Cruceros y 3 Destructores.";
                                            break;
                }
                $mensajeHost = "Espera a que el Contrincante coloque sus barcos.";
                include "./vistas/mostrarPartidaHostBarcosPreparados.php";
                break;

        case 4: 
                
                //Comprobamos barco hundido
                $barcosHundidos = $this->comprobarBarcosHundidos($idPartida,$_SESSION['idUsuario']);
                $mensaje = "Es tu turno. ¡Ataca a tu RIVAL!";
                $mensajeContrincante = "Es el turno del RIVAL. ¡Espera que ataque!";
                include "./vistas/mostrarAtacaHost.php";
                break;
        case 5: 
               
                $barcosHundidos = $this->comprobarBarcosHundidos($idPartida,$_SESSION['idUsuario']);
                $mensaje = "Es tu turno. ¡Ataca a tu RIVAL!";
                $mensajeContrincante = "Es el turno del RIVAL. ¡Espera que ataque!";
                include "./vistas/mostrarAtacaContrincante.php";
                break;
        case 6:                 
                $mensaje = "¡HA GANADO EL HOST DE LA PARTIDA!";
                include "./vistas/mostrarGanador.php";
                break;
        case 7: 
                $mensaje = "¡HA GANADO EL CONTRINCANTE DE LA PARTIDA!";
                include "./vistas/mostrarGanador.php";
                break;
    }

    
    

}

public function mostrarTableros($idPartida){
    $tableros = $this->devolverTablerosDB($idPartida);
    return $tableros;
}

public function crearTableros($idPartida){
    if($this->crearTablerosDB($idPartida)){
        $this->mostrarPartida($idPartida);
    } else{
        $this->mostrarPartida($idPartida);
    };
}









}