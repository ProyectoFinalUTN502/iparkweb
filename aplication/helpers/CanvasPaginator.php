<?php

require_once APPPATH . DS . "helpers" . DS . "paginator" . DS . "IPaginator.php";

class CanvasPaginator implements IPaginator {
    
    private $pagesCount;
    private $currentPage;
    private $prev;
    private $next;
    
    public function __construct() {
        $this->pagesCount = 1;
        $this->currentPage = 1;
    }
    
    public function getPagesCount() {
        return $this->pagesCount;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getPrev() {
        return $this->prev;
    }

    public function getNext() {
        return $this->next;
    }

    public function setPagesCount($pagesCount) {
        $this->pagesCount = $pagesCount;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function setPrev($prev) {
        $this->prev = $prev;
    }

    public function setNext($next) {
        $this->next = $next;
    }
   
    public function isFirst(){
        return $this->currentPage == 1;
    }
    
    public function isLast(){
        return $this->currentPage == $this->pagesCount;
    }
    
    public function display(){
        
        $html = "   <div class='row dt-rb'>
                        <div class='col-sm-6'>
                            <div class='dataTables_info' id='DataTables_Table_2_info'>   
                                Mostrando P&aacute;gina " . $this->currentPage . " de " . $this->pagesCount . " 
                            </div>
                        </div>";
        
        
        if($this->pagesCount > 1){
            $html .= "      <div class='col-sm-6'>   
                                <div class='dataTables_paginate paging_bootstrap'>      
                                    <ul class='pagination'>";
            
            if($this->isFirst()){
                $html .= "  <li class='prev disabled'>
                                <a href='javascript:;'>
                                     ← Anterior
                                </a>
                            </li>";
                
            } else {
               $html .= "  <li class='prev'>
                                <a href='" . $this->prev . "'>
                                     ← Anterior
                                </a>
                            </li> 
                            "; 
            }
            
            $html .= "  <li class='active'>
                            <a href='javascript:;'>" . $this->currentPage . "</a>
                        </li>";
             
            if($this->isLast()){
                $html .= "  <li class='next disabled'>
                                <a href='javascript:;'>
                                    Siguiente → 
                                </a>
                            </li>";
            } else {
                $html .= "  <li class='next'>
                                <a href='" . $this->next . "'>
                                    Siguiente → 
                                </a>
                            </li>";
            }
            
            $html .= "</ul></div>
                        </div>";
        }
        
        
        $html .= "</div>";
 
        return $html;
        
    }
    
}