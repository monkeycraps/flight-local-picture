<?php 

use RedBean_Facade as R;

class Updater {
	
	public function update( $path ){

		R::begin();

		try{


			// $d = R::dispense('directory');
			// $d->path = 'xiunongmei';
			// $d->pid = 0;
			// $o = R::dispense('object');
			// $o->path = 'DSC03737.JPG';
			// $d->ownObject[] = $o;
			// R::store($d);
			// R::commit();
			// die;	


			// 清空缓存
			$pathArr = explode('/', $path);

			$pathNow = './';
			$pid = 0;
			foreach( $pathArr as $one ){

				$pathNow .= $one;
				pline( $pathNow );

				// delete;
				if( $d = R::findOne('directory', 'path = ? and pid = ? ', array( $one, $pid ) ) ){
					if( $listOwnObjectList = $d->ownObject ){
						R::trashAll( $listOwnObjectList );
					}

					$d = R::findOne('directory', 'path = ? and pid = ? ', array( $one, $pid ) );
				}else{
					$d = R::dispense('directory');
					$d->path = $one;
					$d->pid = $pid;
					R::store($d);
				}

				// R::store($d);
				// R::commit();
				// die;

				// insert new 
				$dHandler = opendir($path);

				$oMain = null;
				while( $file = readdir($dHandler) ){

					pline( $file );

					if( in_array($file, array('.', '..')) ){
						continue;
					}

					if( !$extPos = strripos($file, '.') ){
						continue;
					}

					$ext = substr( $file, $extPos + 1 );
					pline( $ext );

					if( !in_array( strtolower($ext), array('jpg', 'jpeg', 'gif', 'png') ) ){
						continue;
					}

					$fileName = str_replace('.'. $ext, '', $file);
					if( substr($fileName, -5) == 'small' ){

						if( $oMain == null ){
							throw new Exception('no main object');
						}
						$oMain->path_small = $pathNow. '/'. $file;

						$oMain = null;
					}else{

						$o = R::dispense('object');
						$o->name = $file;
						$o->path = $pathNow. '/'. $file;
						$d->ownObject[] = $o;

						$oMain = $o;
					}
				}
				R::store($d);
			}

			R::commit();

		}catch(Exception $e){

			R::rollback();
			throw $e;
		}

		return true;
	}

}