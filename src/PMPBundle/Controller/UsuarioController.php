<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PMPBundle\Services as PMPServices;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends Controller implements ContainerAwareInterface
{
    /**
     * @Route("/", name="usuario_index")
     * @Template()
     */
    public function indexAction(){

        return array();
    }

    /**
     * @Route("/novo", name="usuario_novo")
     * @Template()
     */
    public function cadastrarAction(){

        if($_POST){

            $usuario = new Usuario();

            $usuario->setNome($_POST['txtNome']);
            $usuario->setUserName($_POST['txtLogin']);
            $usuario->setPassword($this->encodePassword($usuario, "unimed179"));
            $usuario->setCargo($_POST['cbCargo']);
            $usuario->setCentroCusto($_POST['cbCentroCusto']);
            $usuario->setRoles(array($_POST['cbPerfil']));

            try{
                $serviceUsuario = $this->get('pmp.usuario_busca');
                $serviceUsuario->salvar($usuario);

                $this->addFlash('success', 'Usuario Cadastrado Com sucesso');

                return $this->redirectToRoute('usuario_index');
            }catch (Exception $ex){
                echo $ex->getMessage();
            }

        }

        return array();

    }

    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }

    private function  encodePassword($user,$plainPassword){
        $encoder = $this->container->get("security.encoder_factory")
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

}