<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mobile")
 */
class MobileController extends Controller implements ContainerAwareInterface
{
    /**
     * @Route("/", name="mobile_index")
     * @Template()
     */
    public function indexAction(){



        if($_GET) {
            $serviceUsuario = $this->get('pmp.usuario_busca');
            $usuario = $serviceUsuario->buscarPorNome($_GET['_username']);

            $senhaEstocada = $usuario->getPassword();
            $senhaFormulario = $this->encodePassword($usuario, $_GET['_password']);

            if($senhaFormulario==$senhaEstocada){
                return new Response(json_encode(array('log'=>'borala')));
            }else{
                return new Response(json_encode(array('log'=>'deuruim')));
            }

        }
        return array('teste'=>'teste');

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