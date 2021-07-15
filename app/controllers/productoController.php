<?php

class productoController{

        public function RetornarProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $jsonproductos = Productos::obtenerProductos();
            $response->getBody()->Write(json_encode($jsonproductos));
            return $response ->withHeader('Content-Type', 'application/json');

        }
        public function Alta($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
        

                $productos = new Productos();
                $productos->id_producto = $listaDeParametros['id_producto'];
                $productos->nombre = $listaDeParametros['nombre'];
                $productos->descripcion = $listaDeParametros['descripcion'];
                $productos->precio = $listaDeParametros['precio'];
                $productos->imagen = $listaDeParametros['imagen'];
                

                Productos::CrearProductos($productos);
                $response->getBody()->write(json_encode($productos));

                return $response;
        }
        public function obtenerFormMod($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos = new Productos();
            $productos->id_producto = $listaDeParametros['id_producto'];

            $jsonproductos = Productos::FormModProductos($productos);

            $response->getBody()->Write(json_encode($jsonproductos));
            return $response ->withHeader('Content-Type', 'application/json');


        }
        public function ModProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();

            $productos = new Productos();
            $productos->id_producto = $listaDeParametros['id_producto'];
                $productos->nombre = $listaDeParametros['nombre'];
                $productos->descripcion = $listaDeParametros['descripcion'];
                $productos->precio = $listaDeParametros['precio'];
                $productos->imagen = $listaDeParametros['imagen'];

            Productos::ModificarProductos($productos);
            $response->getBody()->write("producto modificado");

            return $response;

        }
        public function DeleteProductos($request, $response, $args){
            $listaDeParametros = $request->getParsedBody();
            $productos=  new Productos();
            $productos->id_producto =  $listaDeParametros['id_producto'];

            Productos::EliminarProductos($productos);
            $response->getBody()->Write("producto eliminado");
            return $response;

        }


}

?>