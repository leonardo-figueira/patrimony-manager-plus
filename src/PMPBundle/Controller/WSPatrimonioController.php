<?php
/**
 * Created by PhpStorm.
 * User: leonardo
 * Date: 30/09/2015
 * Time: 19:47
 */

namespace PMPBundle\Controller;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Services as PMPService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/ws-patrimonio")
 */
class WSPatrimonioController extends Controller
{
    /**
     * @Route("/lista-centro-custo", name="wslistarcentroCusto")
     * @Template()
     */
    public function listarCentroDeCustoAction()
    {
        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');
        $centroCustos = $serviceCentroCusto->findAll();
        $centroCustoArray = array();

        foreach ($centroCustos as $centroCusto) {
            $centroCustoArray[] = $centroCusto->toArray();
        }

        $response = new JsonResponse($centroCustoArray, 200, array(
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            'Content-Type' => 'application/json'));

        return $response;
    }

    /**
     * @Route("/listar-patrimonios/{id}")
     */
    public function listarPatrimonioCentroCustoAction($id)
    {
        $servicePatrimonio = $this->get('pmp.patrimonio_busca');
        $patrimonios = $servicePatrimonio->findByCentroCusto($id);
        $patrimonioArray = array();

        foreach ($patrimonios as $patrimonio) {
            $patrimonioArray[] = $patrimonio->toArray();
        }

        $response = new JsonResponse($patrimonioArray, 200, array(
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            'Content-Type' => 'application/json'));

        return $response;
    }


    /**
     * @Route("/gravar-patrimonio/{patrimonio}/{centrocusto}/{contapatrimonial}/{descricao}/{dtaquisicao}/{nf}",name="gravaPatrimonioMobile")
     * @Template()
     */
    public function gravarPatrimonioAction($patrimonio, $centrocusto, $contapatrimonial, $descricao, $dtaquisicao, $nf)
    {

        $aResposta = array();

        try {

            $manipulador = $this->get('pmp.patrimonio_edicao');
            $serviceCentroCusto      = $this->get('pmp.centro_custo_busca');
            //$serviceContaPatrimonial = $this->get('pmp.conta_patrimonial_busca');

            $centroCustoPatrimonio = $serviceCentroCusto->find($centrocusto);
            $contaPatrimonialPatrimonio = $this->getDoctrine()->getRepository("PMPBundle:ContaPatrimonial")->find($contapatrimonial);




            $entity = new PMPEntity\Patrimonio();
            $entity->setPlaqueta($patrimonio);
            $var = explode("-", $dtaquisicao);

            $data = $var[2].'-'.$var[1].'-'.$var[0];
            $data = date_create_from_format('Y-m-d', $data);
            $entity->setDtaquisicao($data);
            $entity->setNopatrimonio($descricao);
            $entity->setSituacao(1);
            $entity->setNrnotafiscal($nf);
            $entity->setCentroDeCusto($centroCustoPatrimonio);
            $entity->setContaPatrimonial($contaPatrimonialPatrimonio);

            $manipulador->salvar($entity);

            $stateCode = 200;
            $aResposta = array("message" => "OK");


        } catch (\ErrorException $e) {

            $stateCode = $e->getCode();
            $aResposta = array("message" => $e->getMessage());


        }

        $response = new JsonResponse($aResposta, $stateCode,
            array(
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Credentials' => 'true',
                'Content-Type' => '*'
                //'Content-Type' => 'application/json'
            )
        );

        return $response;

    }
}