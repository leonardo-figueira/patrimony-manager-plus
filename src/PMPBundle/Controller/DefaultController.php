<?php

namespace PMPBundle\Controller;

use PMPBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller implements ContainerAwareInterface
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        if($_POST){

            if($_POST['txtSenha'] != '') {

                $usuarioSalvar = $usr;

                $usuarioSalvar->setPassword($this->encodePassword($usuarioSalvar, $_POST['txtSenha']));

                try {
                    $serviceUsuario = $this->get('pmp.usuario_busca');
                    $serviceUsuario->alterar($usuarioSalvar);

                    $this->addFlash('success', 'Senha Alterado Com sucesso');

                    return $this->redirectToRoute('index');
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }

        }

        $json = array('log'=>'borala');

        $response = new JsonResponse($json);

        return array('usuario' => $usr, $response);
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
