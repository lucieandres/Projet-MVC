<?php
namespace mvcCore\Controllers;
use mvcCore\Views\View;
use mvcCore\Models\InfoModel;
use mvcCore\Models\FriendModel;
use mvcCore\Models\OpinionModel;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 */

class UserController extends Controller {
	
	public function __construct( $model) {
		$this->__model = $model;
		$this->__information = new InfoModel();
		$this->__friend = new FriendModel();
		$this->__opinion = new OpinionModel();
		parent::__construct();
	}

	//
	// Get inputs and set model properties
	// @Override
	public function input( $method = INPUT_POST) {
		// Only from POST data
		if ( count( $_POST) > 0) {
			// Get and set :
			// Mdp, Lastname, Firstname and Email
			$this->__model->setEmail( filter_input( $method, 'email', FILTER_SANITIZE_EMAIL));
			$this->__model->setPassword( filter_input( $method, 'password', FILTER_SANITIZE_STRING));
			$this->__model->setLastname( filter_input( $method, 'lastname', FILTER_SANITIZE_STRING));
			$this->__model->setFirstname(filter_input( $method, 'firstname', FILTER_SANITIZE_STRING));
			$this->__model->setBirthdate( filter_input( $method, 'birthdate', FILTER_SANITIZE_STRING));
			$this->__model->setAddress( filter_input( $method, 'address', FILTER_SANITIZE_STRING));
			$this->__model->setPhonenumber( filter_input( $method, 'phonenumber', FILTER_SANITIZE_NUMBER_INT));
			$this->__model->setSafetyemail( filter_input( $method, 'safetyemail', FILTER_SANITIZE_EMAIL));
		}
	}

	public function inputLogin( $method = INPUT_POST) {
		// Only from POST data
		if ( count( $_POST) > 0) {
			// Get and set :
			// Mdp, Lastname, Firstname and Email
			$this->__model->setEmail( filter_input( $method, 'email', FILTER_SANITIZE_EMAIL));
			$this->__model->setPassword( filter_input( $method, 'password', FILTER_SANITIZE_STRING));
		}
	}

	public function inputInformation( $method = INPUT_POST) {
		// Only from POST data
		if ( count( $_POST) > 0) {
			// Get and set :
			// Mdp, Lastname, Firstname and Email
			$this->__information->setTitle( filter_input( $method, 'title', FILTER_SANITIZE_STRING));
			$this->__information->setContent( filter_input( $method, 'content', FILTER_SANITIZE_STRING));
			$this->__information->setPublic( filter_input( $method, 'public', FILTER_SANITIZE_STRING));
		}
	}
	
	/**
	 * =============================================
	 * Move all the following methods to the abstract Controler class
	 * =============================================
	 */
	
	//
	// Create new order
	// @Override
	public function create( $method = INPUT_POST, $redirect = 'login') {
		// Put Input POST form data into the model
		$this->input( $method);

		// Checl for a persist submit
		$persit = filter_input( $method, 'persist', FILTER_SANITIZE_STRING);

		if(isset($_SESSION['session']))
			$this->redirect( [ 'action' => 'account']);

		else {
			if ( is_null( $persit)) {
				// View instance ( model object, "create")
				$view = View::factory( $this->__model, __FUNCTION__);
				$view->display();
			} else {
				// Persist action
				$error = $this->exists();

				if(empty($error)) {
					if(strlen($this->__model->getPassword()) < 6) 
						$error = "Mot de passe trop court. (6 charactère minimum)";

					else if(strlen($this->__model->getPassword()) > 20) 
						$error = "Mot de passe trop long. (20 charactère maximum)";
					
					else if(strlen($this->__model->getPhonenumber()) < 10)
						$error = "Numéro de téléphone non correcte.";
				}

				if(isset($error)) {
					$GLOBALS['error'] = $error;
					$view = View::factory( $this->__model, __FUNCTION__);
					$view->display();
				} else 
					$this->persist($redirect);
			}
		}
	}

	public function login( $method = INPUT_POST, $redirect = 'account') {
		$this->inputLogin( $method);

		$class = get_class(  $this->__model);
		$models = $this->__dao->read( $class::$_model_table, $class);

		// Check for a update submit
		$login = filter_input( $method, 'login', FILTER_SANITIZE_STRING);

		if(isset($_SESSION['session']))
			$this->redirect( [ 'action' => 'account']);

		else {

		if ( is_null( $login)) {
			$view = View::factory( $this->__model, __FUNCTION__);
			$view->display();
		} else {
				$success = false;
				foreach($models as $model) {
					$model->decrypt();
		
					if($this->__model->getEmail() == $model->getEmail() && $this->__model->getPassword() == $model->getPassword()) {
						$this->__model->generateSession();

						$data = $this->__model->getProperties();
						$data = $this->__model->encrypt( $data);
						$result = $this->__dao->update( $class::$_model_table, $data, 'email', $model->getEmail());

						$_SESSION['session'] = $this->__model->getSession();
						$success = true;
					}
				}

				if(!$success) {
					$GLOBALS['error'] = "Votre email ou votre mot de passe n'est pas correcte.";
					$view = View::factory( $this->__model, __FUNCTION__);
					$view->display();
				} else {
					$this->redirect( [ 'action' => $redirect]);
				}
			}
		}
	}

	public function account( $method = INPUT_POST, $redirect = 'login') {
		$information = filter_input( $method, 'information', FILTER_SANITIZE_STRING);
		$edit = filter_input( $method, 'edit', FILTER_SANITIZE_STRING);
		$delete = filter_input( $method, 'delete', FILTER_SANITIZE_STRING);
		$confirmInformation = filter_input( $method, 'confirmInformation', FILTER_SANITIZE_STRING);
		$update = filter_input( $method, 'update', FILTER_SANITIZE_STRING);

		$GLOBALS['infoModel'] = $this->__information;

		if(empty($_SESSION['session']))
				$this->redirect( [ 'action' => $redirect]);
	
		else {

			$class = get_class(  $this->__model);
			$models = $this->__dao->read( $class::$_model_table, $class, $_SESSION['session']);

			if ( count( $models) != 1) 
				$this->disconnect();
			else {
				$this->__model = $models[0];
				$classInfo = get_class($this->__information);

				$GLOBALS['model'] = $this->__model;
				$GLOBALS['infoList'] = $this->__dao->read($classInfo::$_model_table, $classInfo, $models[0]->getEmail(), 'email');

				if(!is_null($information) && is_null($delete)) {
					$this->inputInformation($method);

					$error;

					if(strlen($this->__information->getTitle()) == 0)
						$error = "Veuillez mettre un titre à votre information.";
					else if(strlen($this->__information->getContent()) == 0)
						$error = "Veuillez mettre un contenu à votre information.";

					if(isset($error)) {
						$GLOBALS['error'] = $error;
					} else {
			
						$this->__information->setEmail($this->__model->getEmail());
						$this->__information->setDate(time());

						$GLOBALS['info'] = "L'information a bien été publié.";
							
						$this->persist(null, $this->__information);
					}

				} else if(!is_null($delete)) {
					$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);
					foreach($GLOBALS['infoList'] as $info) {
						if($_id == $info->getId())
							$this->__dao->delete($classInfo::$_model_table, $_id);
					}

				} else if(!is_null($edit)) {
					$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);
					foreach($GLOBALS['infoList'] as $info) {
						if($_id == $info->getId())
							$GLOBALS['edit'] = $info;
					}

				} else if(!is_null($confirmInformation)) {
					$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);
					$_title = filter_input( $method, 'title', FILTER_SANITIZE_STRING);
					$_content = filter_input( $method, 'content', FILTER_SANITIZE_STRING);

					foreach($GLOBALS['infoList'] as $info) {
						if($_id == $info->getId()) {
							$info->setTitle($_title);
							$info->setContent($_content);
							$info->setPublic(isset($_POST['public']) ? "TRUE" : 'FALSE');

							$classInfo = get_class($info);

							$data = $info->getProperties();
							$data = $info->encrypt($data);

							$this->__dao->update( $classInfo::$_model_table, $data, 'id', $_id);

							$GLOBALS['info'] = "L'information a bien été mis à jour.";
						}
					}

				} else if (isset($_GET['decline'])) {
					$_id = $_GET['decline'];

					$classFriend = get_class($this->__friend);
					$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend, $_id, 'id');

					if(count($_inv) == 1 && $_inv[0]->getUser_re() == $models[0]->getEmail() && $_inv[0]->getState_invite() != "ACCEPTED")
						$this->__dao->delete($classFriend::$_model_table, $_id);

				} else if (isset($_GET['accept'])) {
					$_id = $_GET['accept'];

					$classFriend = get_class($this->__friend);
					$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend, $_id, 'id');

					if(count($_inv) == 1 && $_inv[0]->getUser_re() == $models[0]->getEmail()) {
						$_inv = $_inv[0];
						$_inv->setState_invite('ACCEPTED');

						$classFriend = get_class($_inv);
						$data = $_inv->getProperties();

						$this->__dao->update( $classFriend::$_model_table, $data, 'id', $_id);
					}
				} else if (isset($_GET['deleteFriend'])) {
					$_id = $_GET['deleteFriend'];

					$classFriend = get_class($this->__friend);
					$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend, $_id, 'id');

					if(count($_inv) == 1 && ($_inv[0]->getUser_re() == $models[0]->getEmail() || $_inv[0]->getUser_tr() == $models[0]->getEmail()) && $_inv[0]->getState_invite() == "ACCEPTED")
						$this->__dao->delete($classFriend::$_model_table, $_id);

				} else if(!is_null($update)) {
					$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);
					
					$_class = get_class($this->__model);
					$_user = $this->__dao->read( $_class::$_model_table, $_class, $_id, 'id');

					if(count($_user) == 1 && $_user[0]->getEmail() == $this->__model->getEmail()) {
						$this->__model = $_user[0];
						$this->__model->decrypt();

						$this->__model->setLastname( filter_input( $method, 'lastname', FILTER_SANITIZE_STRING));
						$this->__model->setFirstname(filter_input( $method, 'firstname', FILTER_SANITIZE_STRING));
						$this->__model->setBirthdate( filter_input( $method, 'birthdate', FILTER_SANITIZE_STRING));
						$this->__model->setAddress( filter_input( $method, 'address', FILTER_SANITIZE_STRING));
						$this->__model->setPhonenumber( filter_input( $method, 'phonenumber', FILTER_SANITIZE_NUMBER_INT));

						if(isset($_FILES['picture']) && $_FILES["picture"]["error"] != 4) {
							$uploaddir = 'images/profil/';
							$uploadfile = $uploaddir .time().'_'.basename($_FILES['picture']['name']);

							$imageFileType = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));
							$check = getimagesize($_FILES["picture"]["tmp_name"]);

							if($check !== false) {
								move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
								$this->__model->setPhoto($uploadfile);
							} else
								$GLOBALS['error'] = "Ce fichier n'est pas une image";
						}

						if(empty($GLOBALS['error'])) {
							$_class = get_class($this->__model);
							$data = $this->__model->getProperties();
							$data = $this->__model->encrypt($data);

							$this->__dao->update( $_class::$_model_table, $data, 'id', $_id);
							$GLOBALS['info'] = "Tes informations personnelles ont bien été modifier.";
							$GLOBALS['model'] = $this->__model;
						}
					}
				}


				$models = $this->__dao->read( $class::$_model_table, $class, $_SESSION['session']);
				$this->__model = $models[0];
				
				$classInfo = get_class($this->__information);
				$GLOBALS['infoList'] = $this->__dao->read($classInfo::$_model_table, $classInfo, $this->__model->getEmail(), 'email', 0, 0, 'ORDER BY id DESC');

				$classFriend = get_class($this->__friend);

				$inv = [];
				$friends = [];
				$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend, $models[0]->getEmail(), 'user_re', 0, 0, 'ORDER BY id DESC');

				foreach($_inv as $modal) {
					if($modal->getState_invite() == "ATTENTE") {
						$user = $this->__dao->read($class::$_model_table, $class, $modal->getUser_tr(), 'email')[0];
						array_push($inv, [$user, $modal]);
					}
				}

				$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend);

				foreach($_inv as $modal) {
					if($modal->getState_invite() == "ACCEPTED" && ($modal->getUser_re() == $models[0]->getEmail() || $modal->getUser_tr() == $models[0]->getEmail())) {
						$user = null;
						if($modal->getUser_re() == $models[0]->getEmail())
							$user = $this->__dao->read($class::$_model_table, $class, $modal->getUser_tr(), 'email')[0];
						else
							$user = $this->__dao->read($class::$_model_table, $class, $modal->getUser_re(), 'email')[0];
		
						array_push($friends, [$user, $modal]);
					}
				}

				$GLOBALS['inviteList'] = $inv;
				$GLOBALS['friendList'] = $friends;

				$delete;
				$update;

				$GLOBALS['collapseInfo'] = !is_null($delete);
				if(!is_null($delete))
					$GLOBALS['anchor'] = 'info';
	
				$view = View::factory( $this->__model, __FUNCTION__);
				$view->display();
				
			}
		}
	}

	public function search( $method = INPUT_POST, $redirect = 'login') {
		$class = get_class(  $this->__model);
		$GLOBALS['userList'] = $this->__dao->read($class::$_model_table, $class);

		
		$view = View::factory( $this->__model, __FUNCTION__);
		$view->display();
	}

	public function profil( $method = INPUT_POST, $redirect = 'search') {

		$invit = filter_input( $method, 'invit', FILTER_SANITIZE_STRING);
		$deleteFriend = filter_input( $method, 'deleteFriend', FILTER_SANITIZE_STRING);
		$opinion = filter_input( $method, 'opinion', FILTER_SANITIZE_STRING);
		$error = null;
		$user = null;

		if(!is_null($invit)) {
			$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);

			if(empty($_SESSION['session'])) 
				$error = "Vous devez vous connecter pour envoyer une demande d'ami.";
			else {
				$class = get_class(  $this->__model);
				$models = $this->__dao->read( $class::$_model_table, $class, $_SESSION['session']);

				if(count($models) == 0) {
					session_destroy();
					$error = "Votre session à expiré.";
				}
				else if (count($models) == 1) {
					$this->__model = $models[0];
					$class = get_class(  $this->__model);
					$users = $this->__dao->read( $class::$_model_table, $class, $_id, 'id');

					if(count($users) == 0)
						$error = "Cet utilisateur n'éxiste pas.";

					else if(count($users) == 1) {
						$user = $users[0];

						$friendClass = get_class(  $this->__friend);
						$invitList = $this->__dao->read( $friendClass::$_model_table, $friendClass);

						$sended = false;
						$invited = false;

						foreach($invitList as $inv) {
							if($inv->getState_invite() != "ACCEPTED") {
								if($inv->getUser_tr() == $this->__model->getEmail() && $inv->getUser_re() == $user->getEmail())
									$sended = true;

								if($inv->getUser_re() == $this->__model->getEmail() && $inv->getUser_tr() == $user->getEmail())
									$invited = true;
							}
						}

						if($sended) {
							$error = "Tu as déjà envoyé une demande d'ami à cette utilisateur.";
						} else if($invited)
							$error = "Cet utilisateur t'as déjà envoyé une demande, va sur Mon Compte pour l'accepter.";
						else {
							$invitList = $this->__dao->read( $friendClass::$_model_table, $friendClass);
							$existFriend = $this->isFriend($user->getEmail());

							if($existFriend != -1)
								$error = "Vous êtes déjà amis.";

							else {
								$GLOBALS['success'] = "La demande d'ami(e) à bien été envoyé!.";
								$this->__friend->setUser_tr($this->__model->getEmail());
								$this->__friend->setUser_re($user->getEmail());
								$this->__friend->setState_invite('ATTENTE');

								$this->persist(null, $this->__friend);
							}
						}
					} else
						$error = "Une erreur est survenue.";
					
				}
				else
					$error = "Une erreur est survenue.";
			}
		}

		if(!is_null($deleteFriend)) {
			$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);

			$classFriend = get_class($this->__friend);
			$_inv =  $this->__dao->read($classFriend::$_model_table, $classFriend, $_id, 'id');

			if(count($_inv) == 1 && $this->isFriend($_inv[0]->getUser_re()) && $this->isFriend($_inv[0]->getUser_tr()))
				$this->__dao->delete($classFriend::$_model_table, $_id);
		}

		if(isset($_SESSION['session'])) {
			$class = get_class(  $this->__model);
			$models = $this->__dao->read( $class::$_model_table, $class, $_SESSION['session']);
			$this->__model = $models[0];
		}

		if(empty($_GET['id'])) {
			$this->redirect( [ 'action' => $redirect]);
		} else {
			$class = get_class(  $this->__model);
			$classInfo = get_class(  $this->__information);

			$user = $this->__dao->read($class::$_model_table, $class, $_GET['id'], 'id');
			$infos = [];

			if(count($user) != 1) {
				$this->redirect( [ 'action' => $redirect]);
			} else {
				$model = $user[0];
				$model->decrypt();

				$GLOBALS['user'] = $model;
				$GLOBALS['_modal'] = $this->__model;
			}
		}

		if(!is_null($opinion) && isset($_SESSION['session'])) {
			$_like = filter_input( $method, 'like', FILTER_SANITIZE_STRING);
			$_comment = filter_input( $method, 'comment', FILTER_SANITIZE_STRING);
			$_id = filter_input( $method, 'id', FILTER_SANITIZE_STRING);

			$_classInfo = get_class(  $this->__information);
			$_infos = $this->__dao->read($_classInfo::$_model_table, $_classInfo, $_id, 'id');

			if(count($_infos) == 1) {
				$_info = $_infos[0];

				if($_info->getPublic() == 'TRUE' || ($this->isFriend($_info->getEmail()) != -1)) {
					$this->__opinion->setAppreciated($_like == 'dislike' ? 'FALSE' : 'TRUE');
					$this->__opinion->setComment($_comment);
					$this->__opinion->setInfo_Id($_id);
					$this->__opinion->setEmail($this->__model->getEmail());

					$data = $this->__opinion->getProperties();
					$encrypt_data = $this->__opinion->encrypt( $data);
					$model_class = get_class( $this->__opinion);
					$this->__dao->create( $model_class::$_model_table, $encrypt_data);
				}
			}
		}

		$infos = $this->__dao->read($classInfo::$_model_table, $classInfo, $model->getEmail(), 'email', 0, 0, 'ORDER BY id DESC');

		$model_class = get_class( $this->__opinion);
		$class = get_class(  $this->__model);
		$_infos = [];

		foreach($infos as $info) {
			$opinions = $this->__dao->read($model_class::$_model_table, $model_class, $info->getId(), 'info_id');

			$like = [];
			$dislike = [];

			foreach($opinions as $opinion) {
				$from =  $this->__dao->read($class::$_model_table, $class, $opinion->getEmail(), 'email')[0];

				if($opinion->getAppreciated() == 'FALSE')
					array_push($dislike, [$opinion, $from]);
				else
					array_push($like, [$opinion, $from]);
			}

			if($info->getPublic() != 'TRUE') {
				if(isset($_SESSION['session']) && $this->isFriend($model->getEmail()) != -1)
					array_push($_infos, [$info, $like, $dislike]);
			} else
				array_push($_infos, [$info, $like, $dislike]);
		}

		$_date = [];

		if(isset($_GET['date'])) {
			$date = $_GET['date'];

			foreach($_infos as $info) {
				$_info = $info[0];
				$__date = explode(' ', $_info->getDate())[0];
				$__date = explode('-', $__date);
				if(count($__date) > 1) {
					$__date = $__date[0].'-'.$__date[1];

					if($__date == $date)
						array_push($_date, $info);
				}
			}
			$_infos = $_date;
		}

		$count = count($_infos);

		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			$_infos = array_slice($_infos, $page * 10, ($page + 1) * 10);
		} else
			$_infos = array_slice($_infos, 0, 10);

		$GLOBALS['error'] = $error;
		$GLOBALS['infos'] = $_infos;
		$GLOBALS['count'] = $count;
		$GLOBALS['friend'] = $this->isFriend($model->getEmail());

		$view = View::factory( $this->__model, __FUNCTION__);
		$view->display();
	}

	public function disconnect( $method = INPUT_POST, $redirect = 'login') {
		if(isset($_SESSION['session'])) {
			unset($_SESSION['session']);
			session_destroy();
			$this->redirect( [ 'action' => $redirect]);
		}
	}

	public function exists() {
		$class = get_class(  $this->__model);
		$models = $this->__dao->read( $class::$_model_table, $class);
		
		foreach($models as $model) {
			if($model->getEmail() == $this->__model->getEmail())
				return "Cet email existe déjà.";
		}
		return null;
	}

	public function isFriend($email) {
		$class = get_class(  $this->__friend);
		$invitList = $this->__dao->read( $class::$_model_table, $class);

		if($this->__model->getEmail() == $email)
			return 1;

		foreach($invitList as $inv) {
			if($inv->getUser_tr() == $this->__model->getEmail() && $inv->getUser_re() == $email && $inv->getState_invite() == "ACCEPTED")
				return $inv->getId();
	
			if($inv->getUser_re() == $this->__model->getEmail() && $inv->getUser_tr() == $email && $inv->getState_invite() == "ACCEPTED")
				return $inv->getId();
		}

		return -1;
	}

}
