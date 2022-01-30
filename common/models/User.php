<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property integer $status
 * @property string $password write-only password
 */
class User extends BaseActiveRecord implements IdentityInterface
{
	/**
	 * @var string
	 */
	public $password_repeat;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user}}';
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}

		return static::findOne([
			'password_reset_token' => $token,
			'status' => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 * @return boolean
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return false;
		}

		$timestamp = (int)substr($token, strrpos($token, '_') + 1);
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		return $timestamp + $expire >= time();
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['status', 'default', 'value' => self::STATUS_ACTIVE],
			['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
			[['username'], 'string', 'max' => 128],

			// scenario rules
			[['username'], 'required', 'on' => ['create', 'update', 'profile']],
			['username', 'unique', 'on' => ['create', 'update', 'profile']],
			[['username'], 'filter', 'filter' => 'trim', 'on' => ['create', 'update', 'profile']],
			// password
			[['password', 'password_repeat'], 'filter', 'filter' => 'trim', 'on' => ['create', 'change-password']],
			[['password', 'password_repeat'], 'required', 'on' => ['create', 'change-password']],
			[['password'], 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'max' => 50, 'on' => ['create', 'change-password']],
			['password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => ['create', 'change-password']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => Yii::t('app', 'Login'),
			'password' => Yii::t('app', 'Password'),
			'password_repeat' => Yii::t('app', 'Repeat Password'),
			'status' => Yii::t('app', 'Active'),
			'token' => Yii::t('app', 'Token'),
			'created_at' => Yii::t('app', 'Added'),
			'updated_at' => Yii::t('app', 'Updated'),
			'last_login' => Yii::t('app', 'Last Login'),
			];
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return true;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return $this->password == User::hashPassword($password);
	}

	/**
	 * Get password hash
	 *
	 * @param $password
	 * @return string
	 */
	public static function hashPassword($password)
	{
		return md5($password . Yii::$app->params['user.passwordSaltmain']);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		throw new NotSupportedException('"generateAuthKey" is not implemented.');
	}


	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}

	/**
	 * Create token
	 */
	public function makeToken()
	{
		$this->update();
	}

}
