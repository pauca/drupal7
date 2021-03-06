
<!-- Un node de tipus ct-base nom�s ha de ser visible a tothom si el node �s de tipus 'public' o b� l'usuari est� autenticat -->
<?php 
			$isNodePublic = $node->field_public[0]['value'];
			if ($usuariLogat || $isNodePublic != 'No') :?>
		  	
		<div class="art-Post">
		    <div class="art-Post-body">
		<div class="art-Post-inner">
		<?php ob_start(); ?>

		
		<h2 class="art-PostHeader"> <a href="<?php echo $node_url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
		</h2>
		<?php if ($submitted): ?>
		<div class="art-PostHeaderIcons art-metadata-icons">
		<?php 
					if ($node->field_tipus[0]['view'] == 'acte')
						//Posem la data d'inici de l'acte per evitar confusions amb la data d'introducci� de l'esdeveniment
						echo art_submitted_worker($node->field_dataini[0]['view'], $name); 		
					else
						echo art_submitted_worker($date, $name); 						
		?>
		
		</div>
		<?php endif; ?>
		<?php $metadataContent = ob_get_clean(); ?>
		<?php if (trim($metadataContent) != ''): ?>
		<div class="art-PostMetadataHeader">
		<?php echo $metadataContent; ?>
		
		</div>
		<?php endif; ?>
		<div class="art-PostContent">
			

		<div class="art-article"><?php print $picture; ?>
			
			
			
			<?php 

			/*			
			//LLP: a trav�s de la configuraci� del tipus ct_base, hem fet invisibles aquells camps que no ens interessa veure
			//     en el detall del node. De tota manera, en qualsevol moment podem pintar-los aqu�, ja que a $node->field...
			//     els tenim disponibles, tal i com es mostra a continuaci�
			$node->field_comissio[0]['view'], 
			$node->field_dataini[0]['view'], 
			$node->field_tipus[0]['view'], 
			$node->field_public[0]['view'], 
			$node->field_ambit[0]['view'], 
			
			echo "Debug: ambit:" . $node->field_ambit[0]['view'] . "  pub:" . $node->field_public[0]['view'] .
						"  typ: " . $node->field_tipus[0]['view'] . "  com:" . $node->field_comissio[0]['view'] .
						"  dIini=" . $node->field_dataini[0]['view'];
			*/
			//--------
			
			//LLP: Si el node �s tipus teaser, posem a l'esquerra la imatge petita, i si no posem la menys petita -->
			if ($node->field_imatge[0]['filepath']) //Verifiquem que existeixi la imatge, sin� queden uns espais deguts als marges que molesten
			{
				if ($teaser) 
				{ 
								echo theme('imagecache', 'teaser_ctbase', 
									$node->field_imatge[0]['filepath'], 
									$node->title, 
									$node->title, 
									array('align' => 'left', 'hspace' => '10')); 
				}
				else
				{	
								echo theme('imagecache', 'fullnode_ctbase', 
									$node->field_imatge[0]['filepath'], 
									$node->title, 
									$node->title, 
									array('align' => 'left', 'hspace' => '10')); 
				}				
			}
			
			echo $content; 
			
			
			?>
			
			
		<?php if (isset($node->links['node_read_more'])) { echo '<div class="read_more">'.get_html_link_output($node->links['node_read_more']).'</div>'; }?></div>
		</div>
		<div class="cleared"></div>
		
		<?php if (is_art_links_set($node->links) || !empty($terms)):
		$output = art_node_worker($node); 
		if (!empty($output)):	?>
		<div class="art-PostFooterIcons art-metadata-icons">
		<?php echo $output; ?>
		
		</div>
		<?php endif; endif; ?>
		
		</div>
		
		    </div>
		</div>
		
<?php else: ?>
		<div class="art-Post">
		 <div class="art-Post-body">
			<div class="art-Post-inner">			
			<?php echo t("No esteu autoritzats a visualitzar aquesta informaci&oacute");?>				
			</div>
		 </div>
		</div>
<?php endif; ?>