<?php 

namespace App\Transformer;
 
 use League\Fractal\TransformerAbstract;
  
 class ControlTransformer extends TransformerAbstract {
  
     public function transform($control) {
         return [
             'cont_nombre_es' => $control->cont_nombre_es,
             'cont_nombre_en' => $control->cont_nombre_en,
             'cont_detalles_es' => $control->cont_detalles_es,
             'cont_detalles_en' => $control->cont_detalles_en,
             'rgo_id' => $control->rgo_id,
             'cont_estado' => $control->cont_estado,
         ];
     }
  }