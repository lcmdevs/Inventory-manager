<?php

include("material.php");
include("../conexao.php");

use PHPUnit\Framework\TestCase;

 class materialTest extends TestCase{

    /**
    *@before
    */
    public function AbrirConexao(){
        $conexao = new Conexao();
        $conexao->conectar();
        
    }
  
    public function testBuscarMaterialExistente(){    
        $material = new Material();

        if(!$material->buscarMaterial("Gabinete")){

           $material->cadastrar("Gabinete", "Gabinete novo","Hardware");
        }
         
        $this->assertTrue($material->buscarMaterial("Gabinete"));

    }

    public function testeBuscarMaterialInexistente(){
        $material = new Material();
        $this->assertFalse($material->buscarMaterial("Ventilador"));

    }

    public function testCadastrarMaterialDuplicado(){
        $material = new Material();
        $this->assertFalse($material->cadastrar("Gabinete","Usado","Hardware"));

    }

    public function testRetirarMaterial(){
        $material = new Material();
        $this->assertTrue($material->retirarMaterial("MaterialTest","1","Bau A")) ;

    }

 }




















?>