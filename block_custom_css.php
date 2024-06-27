<?php
class block_custom_css extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_custom_css');
    }

    public function specialization() {
        if (!empty($this->config->custom_css_title)) {
            $this->title = format_string($this->config->custom_css_title);
        }
    }

    public function instance_allow_config() {
        return true;
    }

    public function get_content() {
        global $PAGE, $CFG;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        // Load the custom CSS for this instance of the block
        $this->add_custom_css();

        return $this->content;
    }

    private function add_custom_css() {
        global $PAGE, $CFG;

        $cssFile = 'custom_' . $this->instance->id . '.css';
        $fullPath = $CFG->dirroot . '/blocks/custom_css/' . $cssFile;

        if (!empty($this->config->custom_css)) {
            file_put_contents($fullPath, $this->config->custom_css);
            $PAGE->requires->css('/blocks/custom_css/' . $cssFile . '?v=' . time());
        } else {
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $this->content->text .= html_writer::tag('div', get_string('no_custom_css', 'block_custom_css'), array('class' => 'alert alert-info'));
        }
    }

    public function instance_delete() {
        global $CFG, $DB;

        // Delete the associated CSS file when the block instance is deleted
        $cssFile = 'custom_' . $this->instance->id . '.css';
        $fullPath = $CFG->dirroot . '/blocks/custom_css/' . $cssFile;
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        // Call the parent instance_delete() method
        return parent::instance_delete();
    }
}