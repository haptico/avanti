<?php

class User extends CActiveRecord {

    /**
     * @var int
     * @desc items on page
     */
    public $user_page_size = 10;

    /**
     * @var boolean
     */
    public $captcha = array('registration' => true);

    /**
     * @var boolean
     * @desc use email for activation user account
     */
    public $sendActivationMail = true;

    /**
     * @var boolean
     * @desc activate user on registration (only $sendActivationMail = false)
     */
    public $activeAfterRegister = false;
    static private $_admin;
    static private $_admins;

    /**
     * @var string
     * @desc hash method (md5,sha1 or algo hash function http://www.php.net/manual/en/function.hash.php)
     */
    public $hash = 'md5';

    /**
     * @var boolean
     * @desc allow auth for is not active user
     */
    public $loginNotActiv = false;

    /**
     * @var boolean
     * @desc login after registration (need loginNotActiv or activeAfterRegister = true)
     */
    public $autoLogin = false;

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = -1;
    const STATUS_LOKED = 2;

    /**
     * The followings are the available columns in table 'users':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $email
     * @var string $activkey
     * @var integer $createtime
     * @var integer $lastvisit
     * @var integer $superuser
     * @var integer $status
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.CConsoleApplication
        return ((get_class(Yii::app()) == 'CConsoleApplication' || (get_class(Yii::app()) != 'CConsoleApplication' && $this->isAdmin())) ? array(
                    array('username', 'length', 'max' => 20, 'min' => 3, 'message' => Yii::t("user", "Incorrect username (length between 3 and 20 characters).")),
                    array('password', 'length', 'max' => 128, 'min' => 4, 'message' => Yii::t("user", "Incorrect password (minimal length 4 symbols).")),
                    array('email', 'email'),
                    array('cpf', 'CpfValidator'),
                    array('telefone', 'PhoneNumberValidator'),
                    array('celular', 'PhoneNumberValidator', 'validateWithMask'),
                    array('username', 'unique', 'message' => Yii::t("user", "This user's name already exists.")),
                    array('email', 'unique', 'message' => Yii::t("user", "This user's email address already exists.")),
                    array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t("user", "Incorrect symbols (A-z0-9).")),
                    array('status', 'in', 'range' => array(self::STATUS_NOACTIVE, self::STATUS_ACTIVE, self::STATUS_BANNED)),
                    array('superuser', 'in', 'range' => array(0, 1)),
                    array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
                    array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
                    array('username, email, superuser, status', 'required'),
                    array('superuser, status', 'numerical', 'integerOnly' => true),
                    array('id, username, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on' => 'search'),
                        ) : ((Yii::app()->user->id == $this->id) ? array(
                            array('username, email', 'required'),
                            array('username', 'length', 'max' => 20, 'min' => 3, 'message' => Yii::t("user", "Incorrect username (length between 3 and 20 characters).")),
                            array('email', 'email'),
                            array('username', 'unique', 'message' => Yii::t("user", "This user's name already exists.")),
                            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t("user", "Incorrect symbols (A-z0-9).")),
                            array('email', 'unique', 'message' => Yii::t("user", "This user's email address already exists.")),
                                ) : array()));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t("user", "Id"),
            'username' => Yii::t("user", "Username"),
            'password' => Yii::t("user", "Password"),
            'verifyPassword' => Yii::t("user", "Retype Password"),
            'email' => Yii::t("user", "E-mail"),
            'cpf' => Yii::t("user", "CPF"),
            'telefone' => Yii::t("user", "Telenfone"),
            'celular' => Yii::t("user", "celular"),
            'verifyCode' => Yii::t("user", "Verification Code"),
            'activkey' => Yii::t("user", "Activation key"),
            'createtime' => Yii::t("user", "Registration date"),
            'create_at' => Yii::t("user", "Registration date"),
            'lastvisit_at' => Yii::t("user", "Last visit"),
            'superuser' => Yii::t("user", "Superuser"),
            'status' => Yii::t("user", "Status"),
        );
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'status=' . self::STATUS_ACTIVE,
            ),
            'notactive' => array(
                'condition' => 'status=' . self::STATUS_NOACTIVE,
            ),
            'banned' => array(
                'condition' => 'status=' . self::STATUS_BANNED,
            ),
            'loked' => array(
                'condition' => 'status=' . self::STATUS_LOKED,
            ),
            'superuser' => array(
                'condition' => 'superuser=1',
            ),
            'notsafe' => array(
                'select' => 'id, username, password, email, cpf, telefone, celular, activkey, create_at, lastvisit_at, superuser, status',
            ),
        );
    }

    public function defaultScope() {
        return array(
            'alias' => 'user',
            'select' => 'user.id, user.username, user.email, user.cpf, user.telefone, user.celular, user.create_at, user.lastvisit_at, user.superuser, user.status',
        );
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'UserStatus' => array(
                self::STATUS_NOACTIVE => Yii::t("user", 'Not active'),
                self::STATUS_ACTIVE => Yii::t("user", 'Active'),
                self::STATUS_BANNED => Yii::t("user", 'Banned'),
                self::STATUS_LOKED => Yii::t("user", 'Loked'),
            ),
            'AdminStatus' => array(
                '0' => Yii::t("user", 'No'),
                '1' => Yii::t("user", 'Yes'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cpf', $this->cpf, true);
        $criteria->compare('telefone', $this->telefone, true);
        $criteria->compare('celular', $this->celular, true);
        $criteria->compare('activkey', $this->activkey);
        $criteria->compare('create_at', $this->create_at);
        $criteria->compare('lastvisit_at', $this->lastvisit_at);
        $criteria->compare('superuser', $this->superuser);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->user_page_size,
            ),
        ));
    }

    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at = date('Y-m-d H:i:s', $value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at = date('Y-m-d H:i:s', $value);
    }

    /**
     * @return hash string.
     */
    public function encrypting($string = "") {
        $hash = $this->hash;
        if ($hash == "md5")
            return md5($string);
        if ($hash == "sha1")
            return sha1($string);
        else
            return hash($hash, $string);
    }

    /**
     * Return admin status.
     * @return boolean
     */
    public function isAdmin() {
        if (Yii::app()->user->isGuest)
            return false;
        else {
            if (!isset(self::$_admin)) {
                if ($this->superuser)
                    self::$_admin = true;
                else
                    self::$_admin = false;
            }
            return self::$_admin;
        }
    }

    /**
     * Return admins.
     * @return array syperusers names
     */
    public static function getAdmins() {
        if (!self::$_admins) {
            $admins = $this->active()->superuser()->findAll();
            $return_name = array();
            foreach ($admins as $admin)
                array_push($return_name, $admin->username);
            self::$_admins = $return_name;
        }
        return self::$_admins;
    }

}
