<?php

class usuarioController
{
    public function CrearUsuario($request, $response, $args)
    {
        $listaDeParametros = $request->getParsedBody();
        // $hashDeContrasena = password_hash($listaDeParametros['nuevaContra'], PASSWORD_DEFAULT);

        $usuario = new Usuario();
        $usuario->nombre = $listaDeParametros['nombre'];
        $usuario->contrasenia = $listaDeParametros['contrasena'];

        Usuario::crearUsuario($usuario);
        $response->getBody()->write(json_encode($usuario));

        return $response;
    }

    public function retornarUsuario($request, $response, $args)
    {
        $listaDeParametros = $request->getParsedBody();
        // $hashDeContrasena = password_hash($listaDeParametros['nuevaContra'], PASSWORD_DEFAULT);

        $usuario = new Usuario();
        $usuario->nombre = $listaDeParametros['nombre'];
        $usuario->contrasenia = $listaDeParametros['contrasena'];

        Usuario::retornarUsuario($usuario);
        //$response->getBody()->write(json_encode($usuario));

        return $response;
    }

    /*
public function LeerJSONPost($request, $response, $args){
    // parametro que llego por el ruteo
     $valor =  $args['param'];
   
    //$response->getBody()->Write($valor);
    //objeto enviado via FormData
     //$listaDeParametros = $request->getParsedBody();
     //$response->getBody()->Write($listaDeParametros['pass']);
    //El dato llega por el body como texto
  
    $ObjetoProvenienteDelFront =  json_decode($request->getBody());
    //var_dump($ObjetoProvenienteDelFront);

        //recorro los valores del objeto
        $MiUsuario = new Usuario();
        foreach ($ObjetoProvenienteDelFront as $atr => $valueAtr) {
            $MiUsuario->{$atr} = $valueAtr;
        }


    $response->getBody()->Write(json_encode($MiUsuario));

    return $response;
}
*/
}
?>