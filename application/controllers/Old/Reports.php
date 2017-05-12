<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Reports extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    $this->load->model('admin/reports_model','reports');		
	}
    
    function print_pdf($content,$subject="",$title="")
    { 
        
        $this->load->library("Pdf");
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DreamSoft');
        if(!isset($subject) || $subject=="")
            $subject = "Taxi report";
        $pdf->SetTitle($subject);
        $pdf->SetSubject($subject);
        $pdf->SetKeywords('DreamSoft, PDF,Report,Taxi');
        
        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
        $pdf->SetHeaderData('', '', $subject, date('d-m-Y'));
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        //$lg['a_meta_dir'] = 'rtl';
        //$lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        
        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);
        
        // ---------------------------------------------------------
        
        // add a page
        $pdf->AddPage();
        
        // Restore RTL direction
        //$pdf->setRTL(true);
        
        // set font
       // $pdf->SetFont('aefurat', '', 18);//aealarabiya
        $pdf->SetFont('aemohanad', '',10);
        // print newline
        $pdf->Ln();
        
        // Arabic and English content
        if($title!="")
            $pdf->Cell(0, 12, $title,0,1,'C');
       
        $htmlcontent = $content;
        
        $pdf->WriteHTML($htmlcontent, true, 0, true, 0);
        
        //Close and output PDF document D=>Download   I=>Open
        $pdf->Output('tripReport'.rand(0,1000).'.pdf', 'D');
        //============================================================+
        // END OF FILE
        //============================================================+
         
    }
    //###################################################################################//
    function reportForm()
    {
        
	  if($this->session->userdata('id'))
        {
			$network= $this->session->userdata('network');		 
    		  $data['pageTitle']=lang('TReports');
                $data['network']=$this->reports->getTable('network','network_active','1');
          if($network!=-1)
                 $data['drivers']=$this->reports->getTable('drivers','driverActivation <>','0','networkId='.$network);
          else                   $data['drivers']=$this->reports->getTable('drivers','driverActivation <>','0');

             		$data['levels']=$this->reports->getTable('levels','levelStatus','1');
              $data['tripType']=$this->reports->getTable('tripTypes','typeStatus','1');
               $data['passenger']=$this->reports->getTable('passengers');
          $data['country']=$this->reports->getTable('countries','countryStatus','1');
           $data['city']=$this->reports->getTable('cities','cityStatus','1');
            $data['reason']=$this->reports->getTable('reasons');
			  $this->template->set('adminMenue','reports');
			  $this->template->set('adminSubMenue','orders');
			  $this->template->load('admin/Container', 'admin/reports/page_form',$data);
	     } else {
		   redirect(site_url('admin/Admin'));
		 }
        
        
    }
    //********************************************************//
  /*  function reloadDrivers()
    {
        $id=$this->input->post('id',TRUE);
         $data['drivers']=$this->reports->getTable('drivers','networkId',$id);
        $this->load->view('admin/reports/reloadDrivers',$data);
    }*/
    //**************************************************//
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return Reports::random_color_part() . Reports::random_color_part() . Reports::random_color_part();
    }
    //********************************************************//
    function printReport()
    {
           $data['exportType']=$exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
        
        
        
        
        $filterationTxt=' ';
         $data['orderRange']=$orderRange = $this->input->post('offerRange',TRUE);
         if($orderRange!="")
            {
                $orderArr = explode(' to ',$orderRange);
               $filterationTxt.=lang('Date_Range').' '.lang('From').' '.$orderArr[0].' '.lang('To').' '.$orderArr[1];
            }
        if($repType==2){
                $data['orders'] = $this->reports->get_orders();
             //  $content =
            if($exportType==0)
            $this->load->view('admin/reports/pdf_report',$data);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/pdf_report',$data);
               $this->print_pdf($content,"",lang('Trip_Report').$filterationTxt); 
            }
            //  
        }
        else 
        {
          $data['orders'] = $this->reports->get_Totals();  
       //  $content =
           
             if($exportType==0)
            $this->load->view('admin/reports/pdf_report2',$data);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/pdf_report2',$data);
              $this->print_pdf($content,"",lang('Total_Trip_Report').$filterationTxt);
            }
           //   
        }
     
        
        
    }
    //*************************************/
    function printPdfReport()
    {
       
          $data['exportType']= $exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
        
        
        
        
        $filterationTxt=' ';
         $data['orderRange']=$orderRange = $this->input->post('offerRange',TRUE);
         if($orderRange!="")
            {
                $orderArr = explode(' to ',$orderRange);
               $filterationTxt.=lang('Date_Range').' '.lang('From').' '.$orderArr[0].' '.lang('To').' '.$orderArr[1];
            }
        if($repType==2){
                $data['orders']= $this->reports->get_orders();
           
               $content=$this->load->view('admin/reports/pdf_report',$data,true);
              $this->print_pdf($content,lang('Trip_Report'),lang('Trip_Report').$filterationTxt); 
             
        }
        else 
        {
          $data['orders'] = $this->reports->get_Totals();  
           
           
               $content= $this->load->view('admin/reports/pdf_report2',$data,true);
              $this->print_pdf($content,"",lang('Total_Trip_Report').$filterationTxt);
        }
     
         
    }
    //****************************************************/
    function printChartReport()
    {
         $exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
      /*  $data['PassengersGrp'] = $this->input->post('PassengersGrp',TRUE);
     $data['NetworkGrp'] = $this->input->post('NetworkGrp',TRUE);
     $data['DriversGrp']=$this->input->post('DriversGrp',TRUE);
    
      $data['CityGrp'] = $this->input->post('CityGrp',TRUE);
     $data['CountryrGrp']=$this->input->post('CountryrGrp',TRUE);
     $data['DateGrp']=$this->input->post('DateGrp',TRUE);
     $data['tripTypeGrp']=$this->input->post('tripTypeGrp',TRUE);
     $data['stsGrp']=$this->input->post('stsGrp',TRUE);
        
        */
          $data['grCol']=$this->input->post('grCol',TRUE);
       /* $filterationTxt=' ';
         $data['orderRange']=$orderRange = $this->input->post('offerRange',TRUE);
         if($orderRange!="")
            {
                $orderArr = explode(' to ',$orderRange);
               $filterationTxt.=lang('Date_Range').' '.lang('From').' '.$orderArr[0].' '.lang('To').' '.$orderArr[1];
            }*/
        
          $data['orders'] = $this->reports->get_Totals();  
           
           
              $this->load->view('admin/reports/chart_report',$data);
              
       
    }
    //************************************************//
    function citry_reload()
    {
        $data['country']=$this->input->post('country',TRUE);
        $this->load->view('admin/reports/city_reload',$data);
    }
    //*********************************************//
    function driver_reload()
    {
     $data['network']=$this->input->post('network',TRUE);
        $this->load->view('admin/reports/reloadDrivers',$data);   
    }
    //**********************************************//
    function getCountry()
    {
          $q=$_GET['q'];//, TRUE);
          $arr = $this->reports->get_CReffer($q);
        echo json_encode($arr);
    }
//**********************************************//
    function getCity()
    {
         $q=$_GET['q'];
        $x=$this->uri->segment('4');
        if(!isset($x) || $x=='')$x='';
          $arr = $this->reports->get_CityReffer($q,$x);
        echo json_encode($arr);
    }
    //***********************************************//
     function getLevel()
    {
          $q=$_GET['q'];//, TRUE);
          $arr = $this->reports->get_LReffer($q);
        echo json_encode($arr);
    }
    //*****************************************//
    function getnetwork()
    {
         $q=$_GET['q'];//, TRUE);
          $arr = $this->reports->get_NetReffer($q);
        echo json_encode($arr); 
    }
    //***************************************//
    function getDriver()
    {
        $q=$_GET['q'];
        $x=$this->uri->segment('4');
        if(!isset($x) || $x=='')$x='';
          $arr = $this->reports->get_DReffer($q,$x);
        echo json_encode($arr);   
    }
    //********************************************//
    function getTripType()
    {
        $q=$_GET['q'];//, TRUE);
          $arr = $this->reports->get_TripReffer($q);
        echo json_encode($arr);  
    }
    //************************************************//
    function getpassenger()
    {
         $q=$_GET['q'];//, TRUE);
          $arr = $this->reports->get_PassReffer($q);
        echo json_encode($arr);  
    }
    //###################################### Finnance Report ###################//
    function finnanceForm()
    {
        
	  if($this->session->userdata('id'))
        {
			$network= $this->session->userdata('network');		 
    		  $data['pageTitle']=lang('FReports');
              /*  $data['network']=$this->reports->getTable('network','network_active','1');
          if($network!=-1)
                 $data['drivers']=$this->reports->getTable('drivers','driverActivation <>','0','networkId='.$network);
          else                   $data['drivers']=$this->reports->getTable('drivers','driverActivation <>','0');

             		$data['levels']=$this->reports->getTable('levels','levelStatus','1');
              $data['tripType']=$this->reports->getTable('tripTypes','typeStatus','1');
               $data['passenger']=$this->reports->getTable('passengers');
          $data['country']=$this->reports->getTable('countries','countryStatus','1');
           $data['city']=$this->reports->getTable('cities','cityStatus','1');*/
            $data['reason']=$this->reports->getTable('reasons');
			  $this->template->set('adminMenue','reports');
			  $this->template->set('adminSubMenue','orders');
			  $this->template->load('admin/Container', 'admin/reports/finnance_form',$data);
	     } else {
		   redirect(site_url('admin/Admin'));
		 }
        
        
    }
      //********************************************************//
    function printFReport()
    {
          $data['exportType']= $exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
        
        
        
        
        $filterationTxt=' ';
         $data['orderRange']=$orderRange = $this->input->post('offerRange',TRUE);
         if($orderRange!="")
            {
                $orderArr = explode(' to ',$orderRange);
               $filterationTxt.=lang('Date_Range').' '.lang('From').' '.$orderArr[0].' '.lang('To').' '.$orderArr[1];
            }
        if($repType==2){
                $data['orders'] = $this->reports->get_account();
             //  $content =
            if($exportType==0)
            $this->load->view('admin/reports/Fpdf_report',$data);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/Fpdf_report',$data);
               $this->print_pdf($content,"",lang('Finance_Report').$filterationTxt); 
            }
            //  
        }
        else if($repType==1)
        {
          $data['orders'] = $this->reports->get_Totals();  
     
           
             if($exportType==0)
            $this->load->view('admin/reports/Fpdf_report2',$data);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/Fpdf_report2',$data);
              $this->print_pdf($content,"",lang('Total_Finance_Report').$filterationTxt);
            }
            
        }
     else if($repType==3)
        {
          $data['orders'] = $this->reports->get_Credit();  
     
           
             if($exportType==0)
            $this->load->view('admin/reports/Fbpdf_report',$data);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/Fbpdf_report',$data);
              $this->print_pdf($content,"",lang('bRep_f').$filterationTxt);
            }
            
        }
        
        
    }
    //*************************************/
    function printFPdfReport()
    {
       
          $data['exportType']=$exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
        
        
        
        
        $filterationTxt=' ';
         $data['orderRange']=$orderRange = $this->input->post('offerRange',TRUE);
         if($orderRange!="")
            {
                $orderArr = explode(' to ',$orderRange);
               $filterationTxt.=lang('Date_Range').' '.lang('From').' '.$orderArr[0].' '.lang('To').' '.$orderArr[1];
            }
        if($repType==2){
                $data['orders']= $this->reports->get_account();
           
               $content=$this->load->view('admin/reports/Fpdf_report',$data,true);
              $this->print_pdf($content,lang('Finance_Report'),lang('Finance_Report').$filterationTxt); 
             
        }
        else  if($repType==1)
        {
          $data['orders'] = $this->reports->get_FTotals();  
           
           
               $content= $this->load->view('admin/reports/Fpdf_report2',$data,true);
              $this->print_pdf($content,"",lang('Total_Finance_Report').$filterationTxt);
        }
       else if($repType==3)
        {
          $data['orders'] = $this->reports->get_Credit();  
     
           
             if($exportType==0)
            $this->load->view('admin/reports/Fbpdf_report',$data,true);
            else if($exportType==1){
               $content= $this->load->view('admin/reports/Fbpdf_report',$data,true);
              $this->print_pdf($content,"",lang('bRep_f').$filterationTxt);
            }
            
        }
         
    }
    //****************************************************/
    function printFChartReport()
    {
         $exportType=$this->input->post('exportType',TRUE);//0=>HTML ,1=>PDF,2=>CHART
        $repType=$this->input->post('rep_type',TRUE);//2=>detail ; 1=>Summary
        $data['passengerCol']=$this->input->post('passengerCol',TRUE);
        $data['driverCol']=$this->input->post('driverCol',TRUE);
        $data['Total_PriceCol']=$this->input->post('Total_PriceCol',TRUE);
        $data['DateCol']=$this->input->post('DateCol',TRUE);
        $data['StatusCol']=$this->input->post('StatusCol',TRUE);
        $data['DistancesCol']=$this->input->post('DistancesCol',TRUE);
       
      
          $data['grCol']=$this->input->post('grCol',TRUE);
      
        
          $data['orders'] = $this->reports->get_FTotals();  
           
           
              $this->load->view('admin/reports/Fchart_report',$data);
              
       
    }
  //***************************************************//
    function StaticseForm()
    {
        
	  if($this->session->userdata('id'))
        {
			$network= $this->session->userdata('network');		 
    		  $data['pageTitle']=lang('Sreport');
            
            $data['reason']=$this->reports->getTable('reasons');
			  $this->template->set('adminMenue','reports');
			  $this->template->set('adminSubMenue','orders');
			  $this->template->load('admin/Container', 'admin/reports/statics_form',$data);
	     } else {
		   redirect(site_url('admin/Admin'));
		 }
        
        
    }
    //*********************************************//
    function printSChartReport()
    {
       
       $data['repType']=$this->input->post('rep_type',TRUE);
       $data['tenRequest']=$this->input->post('tenRequest',TRUE);
         $bitmode=$this->input->post('bitmode',TRUE);
      if(isset($bitmode))
   {
       $data['mode']=$mode=$bitmode;
   }else $data['mode']=$mode=0;
        
          $data['orders'] = $this->reports->get_STotals();  
           if($mode==0){
           
              $this->load->view('admin/reports/Schart_report',$data);
       } else{ $this->load->view('admin/reports/Schart_report2',$data);}
    }
    //***************************************/
     function printSChartReport2()
    {
       
       $data['repType']=$this->input->post('rep_type',TRUE);
       $data['tenRequest']=$this->input->post('tenRequest',TRUE);
         $bitmode=$this->input->post('bitmode',TRUE);
    $data['mode']=$mode=1;
        
          $data['orders'] = $this->reports->Sreport2();  
         $this->load->view('admin/reports/Schart_report2',$data);
    }
    //*********************************************//
}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */