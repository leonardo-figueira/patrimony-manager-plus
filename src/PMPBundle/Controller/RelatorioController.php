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
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/relatorio")
 */
class RelatorioController extends Controller
{
    /**
     * @Route("/patrimonio-situacao", name="patrimonio_por_situacao")
     * @Template()
     */
    public function patrimonioPorSituacaoAction()
    {
        $cc = '';

        if($_POST){
            if($_POST['centroCusto']){
                $cc = $_POST['centroCusto'];
            }
        }

        $serviceCentroCusto = $this->get('pmp.centro_custo_busca');
        $centroCustos = $serviceCentroCusto->findAll();

        $servicePatrimonio = $this->get('pmp.patrimonio_busca');
        $result = $servicePatrimonio->patrimonioPorSituacao($cc);

        return array('resultados' => $result, 'centroCustos' => $centroCustos);
    }

    /**
     * @Route("/patrimonio-conta-patrimonial", name="patrimonio_conta_patrimonial")
     * @Template()
     */
    public function patrimonioContaPatrimonialAction()
    {

        $servicePatrimonio = $this->get('pmp.patrimonio_busca');
        $result = $servicePatrimonio->patrimonioContaPatrimonial();

        return array('resultados' => $result);
    }


}