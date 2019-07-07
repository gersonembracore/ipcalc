<?php 

	class IpCalc {

		private $ipDec;
		private $mskDec;
		private $nwDec;
		private $brdDec;

		private $qtdeHosts;
		private $qtdeHostsIncludeNwBrd;

		private $mskBit;

		private $ipBin;
		private $mskBin;
		private $mskBinInversa;
		private $nwBin;
		private $brdBin;


		public function setIpDec($newIpDec) { $this->ipDec = $newIpDec; }
		public function setMskDec($newMskDec) { $this->mskDec = $newMskDec; }
		public function setNwDec($newNwDec) { $this->nwDec = $newNwDec; }
		public function setBrdDec($newBrdDec) { $this->brdDec = $newBrdDec; }
		
	
		public function setQtdeHosts($newQtdeHosts) { 
			$this->qtdeHosts = $newQtdeHosts;
			}
	
		public function setQtdeHostsIncludeNwBrd($newQtdeHostsIncludeNwBrd) { 
			$this->qtdeHostsIncludeNwBrd = $newQtdeHostsIncludeNwBrd;
			}



		public function setMskBit($newMskBit) {
			
			// Descobrir a quantidade hosts suportada na rede
			$qtdeHosts = pow(2, (32 - $newMskBit)) - 2 ;

			// Descobrir a quantidade hosts suportada na rede, incluindo network e broadcast
			$qtdeHostsIncludeNwBrd = pow(2,(32 - $newMskBit)) ;


			$this->qtdeHosts = $qtdeHosts;
			$this->qtdeHostsIncludeNwBrd = $qtdeHostsIncludeNwBrd;


			$mskBit2Dec = '';
			$newMskBin2Dec = '';
			$arrayMskOctetoBin = array();
			$arrayMskOctetoDec = array();
			
			for ($i=1; $i < 33; $i++) { 
				
				if ($i <= $newMskBit) {
					$mskBit2Dec .= '1';									
				}else{
					$mskBit2Dec .= '0';
				}
			}


			$arrayMskOcteto[0] = substr($mskBit2Dec, 0, 8);
			$arrayMskOcteto[1] = substr($mskBit2Dec, 8, 8);
			$arrayMskOcteto[2] = substr($mskBit2Dec, 16, 8);
			$arrayMskOcteto[3] = substr($mskBit2Dec, 24, 8);

			for ($i=0; $i < 4; $i++) { 
				$arrayMskOctetoDec[$i] = bindec("$arrayMskOcteto[$i]");
			}

			

			foreach ($arrayMskOctetoDec as $oct) {
				$newMskBin2Dec .= $oct . ".";
			}

			$newMskBin2Dec = substr($newMskBin2Dec, 0, -1);

			$this->setMskDec($newMskBin2Dec);

			}





		public function getIpDec() {return $this->ipDec;}
		public function getMskDec() {return $this->mskDec;}
		public function getNwDec() {return $this->nwDec;}
		public function getBrdDec() {return $this->brdDec;}

		public function getQtdeHosts() { return $this->qtdeHosts;}
		public function getQtdeHostsIncludeNwBrd() { return $this->qtdeHostsIncludeNwBrd;}


		public function setIpBin($newIpBin) { $this->ipBin = $newIpBin; }
		public function setMskBin($newMskBin) { $this->mskBin = $newMskBin; }
		public function setMskBinInversa($newMskBinInversa) { $this->mskBinInversa = $newMskBinInversa; }
		public function setNwBin($newNwBin) { $this->nwBin = $newNwBin; }
		public function setBrdBin($newBrdBin) { $this->brdBin = $newBrdBin; }

		public function getIpBin() {return $this->ipBin;}
		public function getMskBin() {return $this->mskBin;}
		public function getMskBinInversa() {return $this->mskBinInversa;}
		public function getNwBin() {return $this->nwBin;}
		public function getBrdBin() {return $this->brdBin;}





		public function ConverterNetworkBinParaDecimal($newNwBin) {

			// Converter endereço binário do network para decimal, processando um octeto de cada vez

			$arrayMskOcteto = array();
			$newNwBin2Dec = '';

			$arrayNwOcteto[0] = substr($newNwBin, 0, 8);
			$arrayNwOcteto[1] = substr($newNwBin, 8, 8);
			$arrayNwOcteto[2] = substr($newNwBin, 16, 8);
			$arrayNwOcteto[3] = substr($newNwBin, 24, 8);



			for ($i=0; $i < 4; $i++) { 
				$arrayNwOctetoDec[$i] = bindec("$arrayNwOcteto[$i]");
			}

			

			foreach ($arrayNwOctetoDec as $oct) {
				$newNwBin2Dec .= $oct . ".";
			}

			$newNwBin2Dec = substr($newNwBin2Dec, 0, -1);

			$this->setNwDec($newNwBin2Dec);
		}






		public function ConverterBroadcastBinParaDecimal($newBrdBin) {

			// Converter endereço binário do broadcast para decimal, processando um octeto de cada vez

			$arrayBrdOcteto = array();
			$newBrdBin2Dec = '';

			$arrayBrdOcteto[0] = substr($newBrdBin, 0, 8);
			$arrayBrdOcteto[1] = substr($newBrdBin, 8, 8);
			$arrayBrdOcteto[2] = substr($newBrdBin, 16, 8);
			$arrayBrdOcteto[3] = substr($newBrdBin, 24, 8);



			for ($i=0; $i < 4; $i++) { 
				$arrayBrdOctetoDec[$i] = bindec("$arrayBrdOcteto[$i]");
			}

			

			foreach ($arrayBrdOctetoDec as $oct) {
				$newBrdBin2Dec .= $oct . ".";
			}

			$newBrdBin2Dec = substr($newBrdBin2Dec, 0, -1);

			$this->setBrdDec($newBrdBin2Dec);
		}




	
	
		// Função para converter IP para binário
		public function calculaNw() {

			$ipArray = explode('.', $this->getIpDec());
			$mskArray = explode('.', $this->getMskDec());

			$bitIpBin = '';
			$bitMskBin = '';
			$bitNwBin = '';
			$bitBrdBin = '';

			// Definir endereço IP em binário
			foreach ($ipArray as $bitIpDec) {
				$bitIpBin .= sprintf('%08d',decbin($bitIpDec));
			}

			// Definir máscara de rede em binário
			foreach ($mskArray as $bitMskDec) {
				$bitMskBin .= sprintf('%08d',decbin($bitMskDec));
			}

			



			// Array do endereço IP em binário
			$arrayIpBin = str_split($bitIpBin);

			// Array da máscara em binário
			$arrayMskBin = str_split($bitMskBin);

			$bitMskBinInversa = '';

			foreach ($arrayMskBin as $bitMsk) {
				if ($bitMsk == '1') {
					$bitMskBinInversa .= '0';
				} else {
					$bitMskBinInversa .= '1';
				}
			}



			// Array da máscara invertida em binário
			$arrayMskBinInversa = str_split($bitMskBinInversa);



			/*	
				Laço com cálculo bit-a-bit usando o AND entre o endereço IP binário e 
			 	a máscara em binário para calcular a network
			*/
			for ($i = 0 ; $i < 32 ; $i++) { 
				$bitNwBin .= $arrayIpBin[$i] & $arrayMskBin[$i];
			}

			/* 
				Laço com cálculo bit-a-bit usando o OR entre o endereço IP binário e
				a máscara inversa para calcular o broadcast.
			*/
			for ($i = 0 ; $i < 32 ; $i++) { 
				$bitBrdBin .= $arrayIpBin[$i] | $arrayMskBinInversa[$i];
			}


			$this->setIpBin($bitIpBin);
			$this->setMskBin($bitMskBin);
			$this->setNwBin($bitNwBin);
			$this->setMskBinInversa($bitMskBinInversa);
			$this->setBrdBin($bitBrdBin);

			$this->ConverterNetworkBinParaDecimal($bitNwBin);
			$this->ConverterBroadcastBinParaDecimal($bitBrdBin);

		}



	}
	

 ?>