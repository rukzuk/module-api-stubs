<?php
namespace Render\APIs\RootAPIv1;
interface RootCssAPI
{
    public function getAllUnitData($rootUnit);
    /**
   * Returns the parent unit for the given unit
   *
   * @param Unit $unit unit array or unit id
   *
   * @return Unit|null
   */
    public function getParentUnit(\Render\Unit $unit);
    /**
   * Returns the form value of the given unit
   *
   * @param Unit  $unit          unit that holds the form value
   * @param mixed $key           key of the requested form value
   * @param mixed $fallbackValue result if formValue array misses key
   *
   * @return mixed
   */
    public function getFormValue(\Render\Unit $unit, $key, $fallbackValue = NULL);
    /**
   * Returns a list of all children units of the given unit
   *
   * @param Unit $unit the unit object
   *
   * @return \Render\Unit[]
   */
    public function getChildren(\Render\Unit $unit);
    /**
   * Returns the Unit object for a given unitId, null if not found
   *
   * @param $unitId
   *
   * @return null|\Render\Unit
   */
    public function getUnitById($unitId);
    /**
   * Returns the module info object for the given unit, null if not found
   *
   * @param \Render\Unit $unit
   *
   * @return null|\Render\ModuleInfo
   */
    public function getModuleInfo(\Render\Unit $unit);
    /**
   * Get values from the permanent unit cache
   * @param Unit   $unit
   * @param string $key unique key
   *
   * @throws \Exception
   * @returns array returns empty array if key was not found
   */
    public function getUnitCache(\Render\Unit $unit, $key);
    /**
   * Set values in the permanent unit cache
   *
   * @param Unit   $unit
   * @param string $key   unique key
   * @param array  $value any typ of array containing only primitive types
   *
   * @throws \Exception
   */
    public function setUnitCache(\Render\Unit $unit, $key, $value);
    /**
   * Returns true if the current renderings happens inside of
   * the rukzuk cms edit mode. Else false.
   *
   * @return bool
   */
    public function isEditMode();
    /**
   * Returns true if the current renderings happens inside of
   * the rukzuk cms preview mode. Else false.
   *
   * @return bool
   */
    public function isPreviewMode();
    /**
   * Returns true if the current rendering happens on a
   * live server (website is deployed). Else false.
   *
   * @return bool
   */
    public function isLiveMode();
    /**
   * Returns the resolutions array
   *
   * @return array
   */
    public function getResolutions();
    /**
   * Returns true when the current rendering task renders a template
   *
   * @return bool
   */
    public function isTemplate();
    /**
   * Returns true when the current rendering task renders a page
   *
   * @return bool
   */
    public function isPage();
    /**
   * Returns the navigation object
   *
   * @return Navigation
   */
    public function getNavigation();
    /**
   * Convert a color id to a rgba() value
   *
   * @param string $colorId
   *
   * @return string rgba() value of the given color id
   */
    public function getColorById($colorId);
    /**
   * Returns the Color Scheme as array map
   *
   * @return array (color-id => color-value)
   */
    public function getColorScheme();
    /**
   * Returns the media item with the given media id
   * or null if the image does not exists.
   *
   * @param string $mediaId
   *
   * @throws MediaItemNotFoundException
   * @return MediaItem
   */
    public function getMediaItem($mediaId);
    /**
   * Returns the language code of the current cms user interface.
   *
   * @return string The language code (examples: en; de; fr)
   */
    public function getInterfaceLanguage();
}