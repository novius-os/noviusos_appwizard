<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

Nos\I18n::current_dictionary('noviusos_appwizard::common');
?>
<div class="model input_item">
    <div class="model_information">
        <div class="labelled_input">
            <label>
                <?= __('Name (e.g. Monkey):') ?>
            </label>
            <input type="text" name="name" class="model_name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Table name (e.g. monkeys):') ?>
            </label>
            <input type="text" name="table_name" class="table_name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Column prefix (e.g. monk_):') ?>
            </label>
            <input type="text" name="column_prefix" class="column_prefix" />
        </div>
        <div class="labelled_input has_url_enhancer">
            <label>
                <?= __('Add an URL enhancer?') ?>
            </label>
            <input type="checkbox" name="has_url_enhancer" />
        </div>
        <div class="labelled_input has_twinnable_behaviour">
            <label>
                <?= __('Is twinnable?') ?>
            </label>
            <input type="checkbox" name="has_twinnable_behaviour" />
        </div>
        <div class="labelled_input has_publishable_behaviour">
            <label>
                <?= __('Is publishable?') ?>
            </label>
            <input type="checkbox" name="has_publishable_behaviour" />
        </div>
        <div class="labelled_input has_author_behaviour">
            <label>
                <?= __('Has author?') ?>
            </label>
            <input type="checkbox" name="has_author_behaviour" />
        </div>
    </div>
</div>
