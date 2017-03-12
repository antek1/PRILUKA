


<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									
										<a href="product.php?id=<?php echo $vino->id ?>">  <img src="privatno/vina/img/<?php echo $vino->slika; ?>" class="img-rounded" width="250px" height="250px" /></a>
										<a href="product.php?id=<?php echo $vino->id ?>"
										<h4 style="font-weight: bold;"><?php echo $vino->sorta_vina . " " . $vino->zapremnina ?>l</h4>
										</a>
										<h3><?php echo $vino->cijena ?> kn</h3>
										<p><?php echo $vino->kvaliteta_vina ?></p>
										<p>Alkohol <?php echo $vino->postotak_alkohola ?> %</p>
										<p><?php echo $vino->naziv ?></p>

										<h5>   <?php echo $vino->godina_berbe ?></h5>
										<a href="product.php?id=<?php echo $vino->id ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Dodati u  košaricu</a>
									</div>
								
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									<?php if(isset($_SESSION["autoriziran"]) && $_SESSION["autoriziran"]->uloga=="korisnik"){
										?>	
										<li><a href="#"><i class="fa fa-plus-square"></i>Dodati na listu zelja</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Usporedba</a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>						