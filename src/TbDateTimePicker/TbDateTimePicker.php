<?php
/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @package   RadekDostal\NetteComponents\DateTimePicker
 * @example   http://addons.nette.org/radekdostal/nette-datetimepicker
 * @author    Ing. Radek Dostál, Ph.D. <radek.dostal@gmail.com>
 * @copyright Copyright (c) 2014  - 2015 Radek Dostál
 * @license   GNU Lesser General Public License
 * @link      http://www.radekdostal.cz
 */

namespace RadekDostal\NetteComponents\DateTimePicker;

use Nette\Forms\Container;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\DateTime;

/**
 * Twitter Bootstrap DateTimePicker Input Control
 *
 * @author Radek Dostál
 */
class TbDateTimePicker extends TextInput
{
  /**
   * Default format
   *
   * @var string
   */
  private $format = 'd.m.Y H:i';

  /**
   * Initialization
   *
   * @param string $label label
   * @param int $cols width of element
   * @param int $maxLength maximum count of chars
   */
  public function __construct($label = NULL, $cols = NULL, $maxLength = NULL)
  {
    parent::__construct($label, $cols, $maxLength);
  }

  /**
   * Sets custom format
   *
   * @param string $format format
   * @return self
   */
  public function setFormat($format)
  {
    $this->format = $format;

    return $this;
  }

  /**
   * Returns date and time
   *
   * @return mixed
   */
  public function getValue()
  {
    if (strlen($this->value) > 0)
      return DateTime::createFromFormat($this->format, $this->value);

    return $this->value;
  }

  /**
   * Sets date and time
   *
   * @param string $value date and time
   * @return void
   */
  public function setValue($value)
  {
    if ($value instanceof \DateTime)
      $value = $value->format($this->format);

    parent::setValue($value);
  }

  /**
   * Registers this control
   *
   * @param string $format format
   * @return self
   */
  public static function register($format = NULL)
  {
    Container::extensionMethod('addTbDateTimePicker', function($container, $name, $label = NULL, $cols = NULL, $maxLength = NULL) use ($format)
    {
      $picker = $container[$name] = new TbDateTimePicker($label, $cols, $maxLength);

      if ($format !== NULL)
        $picker->setFormat($format);

      return $picker;
    });
  }
}