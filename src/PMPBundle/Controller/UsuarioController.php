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

        $serviceUsuario = $this->get('pmp.usuario_busca');
        $lista = $serviceUsuario->buscarTodos();

        return array('usuarios' => $lista);
    }

    /**
     * @Route("/novo", name="usuario_novo")
     * @Template()
     */
    public function cadastrarAction(){

        $serviceCargo = $this->get('pmp.cargo_busca');

        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');

        $centroCustos = $serviceCentroCusto->findAll();

        if($_POST){

            $usuario = new Usuario();

            $usuario->setNome($_POST['txtNome']);
            $usuario->setUserName($_POST['txtLogin']);
            $usuario->setPassword($this->encodePassword($usuario, "unimed179"));
            $usuario->setCargo($serviceCargo->buscarPorId($_POST['cbCargo']));
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

        $cargos = $serviceCargo->buscarTodos();

        return array('cargos'=>$cargos,'centroCustos' =>$centroCustos);

    }

    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }

    private function  encodePassword($user,$plainPassword){
        $encoder = $this->container->get("security.encoder_factory")
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    /**
     * @Route("/excluir/{usuario}", name="usuario_excluir")
     * @Template()
     */
    public function excluirAction(Usuario $usuario){
        try{
            $serviceUsuario = $this->get('pmp.usuario_busca');
            $serviceUsuario->excluir($usuario);

            $this->addFlash('success', 'Usuario Excluido Com sucesso');

            return $this->redirectToRoute('usuario_index');
        }catch (Exception $ex){
            echo $ex->getMessage();
        }

    }

    /**
     * @Route("/editar/{usuario}", name="usuario_editar")
     * @Template()
     */
    public function editarAction(Usuario $usuario){

        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');

        $centroCustos = $serviceCentroCusto->findAll();

        if($_POST){

            $usuario->setNome($_POST['txtNome']);
            $usuario->setUserName($_POST['txtLogin']);
            if($_POST['txtSenha'] != ''){
                $usuario->setPassword($this->encodePassword($usuario, $_POST['txtSenha']));
            }
            $usuario->setCargo($_POST['cbCargo']);
            $usuario->setCentroCusto($_POST['cbCentroCusto']);
            $usuario->setRoles(array($_POST['cbPerfil']));

            try{
                $serviceUsuario = $this->get('pmp.usuario_busca');
                $serviceUsuario->alterar($usuario);

                $this->addFlash('success', 'Usuario Alterado Com sucesso');

                return $this->redirectToRoute('usuario_index');
            }catch (Exception $ex){
                echo $ex->getMessage();
            }

        }

        return array('usuario' => $usuario, 'centroCustos' =>$centroCustos);
    }

}