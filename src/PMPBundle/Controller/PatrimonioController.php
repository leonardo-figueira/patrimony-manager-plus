<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/patrimonio")
 */
class PatrimonioController extends Controller
{

    /**
     * @Route("/", name="patrimonio_index")
     * @Template()
     */
    public function indexAction()
    {
        $patrimonios = null;

        If($_POST) {

            If ($_POST['txtPlaqueta'] !='' and $_POST['txtDescricao'] == '') {

                $plaqueta = $_POST['txtPlaqueta'];
                $descricao = '';
                /* @var PMPService\Patrimonio\PatrimonioBusca  */
                $service = $this->get('pmp.patrimonio_busca');
                $patrimonios = $service->buscar($plaqueta,$descricao);

            }

            If ($_POST['txtPlaqueta'] == '' and $_POST['txtDescricao'] != '') {
                $descricao = $_POST['txtDescricao'];
                $plaqueta = '';
                /* @var PMPService\Patrimonio\PatrimonioBusca  */
                $service = $this->get('pmp.patrimonio_busca');
                $patrimonios = $service->buscar($plaqueta,$descricao);

            }

        }

        return array('patrimonios' => $patrimonios);
    }



    /**
     * @Route("/novo", name="patrimonio_salvar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function salvarAction(Request $request)
    {
        $manipulador = $this->get('pmp.patrimonio_edicao');
        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');
        $serviceContaPatrimonial = $this->get('pmp.conta_patrimonial_busca');

        $entity = new PMPEntity\Patrimonio();
        $entity->setContaPatrimonial($request->request->get('patrimonioContaPatrimonial'));
        $entity->setPlaqueta($request->request->get('patrimoniPlaqueta'));
        $entity->setCentroDeCusto($request->request->get('patrimonioCentroCusto'));

        $var = explode("-",$request->request->get('patrimonioDtAquisicao'));
        $data = $var[2].'-'.$var[1].'-'.$var[0];
        $data = date_create_from_format('Y-m-d',$data);
        $entity->setDtaquisicao($data);
        $entity->setNopatrimonio($request->request->get('patrimonioDescicao'));
        $entity->setSituacao($request->request->get('patrimonioSituacao'));
        $entity->setNrnotafiscal((int)$request->request->get('patrimonioNotaFiscal'));
        $entity->setCentroDeCusto($serviceCentroCusto->find($request->request->get('patrimonioCentroCusto')));
        $entity->setContaPatrimonial($serviceContaPatrimonial->find($request->request->get('patrimonioContaPatrimonial')));
        $manipulador->salvar($entity);


        return $this->redirectToRoute('patrimonio_cadastro');
    }

    /**
     * @Route("/editar/{id}", name="patrimonio_editar")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editarAction(Request $request,PMPEntity\Patrimonio $id)
    {
        $manipulador = $this->get('pmp.patrimonio_edicao');
        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');
        $serviceContaPatrimonial = $this->get('pmp.conta_patrimonial_busca');

        $entity = $id;

        $entity->setContaPatrimonial($request->request->get('patrimonioContaPatrimonial'));
        $entity->setPlaqueta($request->request->get('patrimoniPlaqueta'));
        $entity->setCentroDeCusto($request->request->get('patrimonioCentroCusto'));

        $var = explode("-",$request->request->get('patrimonioDtAquisicao'));
        $data = $var[2].'-'.$var[1].'-'.$var[0];
        $data = date_create_from_format('Y-m-d',$data);
        $entity->setDtaquisicao($data);
        $entity->setNopatrimonio($request->request->get('patrimonioDescicao'));
        $entity->setSituacao($request->request->get('patrimonioSituacao'));
        $entity->setNrnotafiscal((int)$request->request->get('patrimonioNotaFiscal'));
        $entity->setCentroDeCusto($serviceCentroCusto->find($request->request->get('patrimonioCentroCusto')));
        $entity->setContaPatrimonial($serviceContaPatrimonial->find($request->request->get('patrimonioContaPatrimonial')));


        $manipulador->editar($entity);


        return $this->redirectToRoute('patrimonio_cadastro');
    }

    /**
     * @Route("/cadastro", name="patrimonio_cadastro")
     * Template()
     */
    public function cadastrarAction()
    {
        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');

        $centroCustos = $serviceCentroCusto->findAll();

        $serviceContaPatrimonial = $this->get('pmp.conta_patrimonial_busca');

        $contasPatrimoniais = $serviceContaPatrimonial->findAll();

        $data = array(
            'centroCustos' => $centroCustos,
            'contaPatrimoniais'=> $contasPatrimoniais);
        return $this->render('PMPBundle:Patrimonio:cadastrar.html.twig',$data);
    }


    /**
     * @Route("/editar-patrimonio/{id}", name="patrimonio_editarPatrimonio")
     * Template()
     */
    public function editarPatrimonioAction($id)
    {
        $service = $this->get('pmp.patrimonio_busca');
        $entity = $service->findById($id);

        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');

        $centroCustos = $serviceCentroCusto->findAll();

        $serviceContaPatrimonial = $this->get('pmp.conta_patrimonial_busca');

        $contasPatrimoniais = $serviceContaPatrimonial->findAll();

        return $this->render('PMPBundle:Patrimonio:editar.html.twig',array('entity'=> $entity,'centroCustos' => $centroCustos,'contaPatrimoniais'=> $contasPatrimoniais));
    }




}