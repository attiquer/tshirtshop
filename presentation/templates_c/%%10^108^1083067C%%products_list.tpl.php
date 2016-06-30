<?php /* Smarty version 2.6.25-dev, created on 2016-06-29 11:36:48
         compiled from products_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load_presentation_object', 'products_list.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_load_presentation_object(array('filename' => 'products_list','assign' => 'obj'), $this);?>

<?php if ($this->_tpl_vars['obj']->mrTotalPages > 1): ?>
    <p>
        Page <?php echo $this->_tpl_vars['obj']->mPage; ?>
 of <?php echo $this->_tpl_vars['obj']->mrTotalPages; ?>

        <?php if ($this->_tpl_vars['obj']->mLinkToPreviousPage): ?>
            <a href="<?php echo $this->_tpl_vars['obj']->mLinkToPreviousPage; ?>
">Previous</a>
            <?php else: ?>
            Previous
        <?php endif; ?>
        <?php if ($this->_tpl_vars['obj']->mLinkToNextPage): ?>
            <a href="<?php echo $this->_tpl_vars['obj']->mLinkToNextPage; ?>
">Next</a>
            <?php else: ?>
            Next
        <?php endif; ?>
    </p>
<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->mProducts): ?>
    <table class="product-list" border="0">
        <tbody>
        <?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mProducts) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
            <?php if ($this->_sections['k']['index'] % 2 == 0): ?>
                <tr>
            <?php endif; ?>
                    <td valign="top">
                        <h3 class="product-title">
                            <a href="<?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['link_to_product']; ?>
">
                                <?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['name']; ?>

                            </a>
                        </h3>
                        <p>
                            <?php if ($this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['thumbnail']): ?>
                                <a href="<?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['link_to_product']; ?>
">
                                    <img src="<?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['thumbnail']; ?>
" alt="<?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['name']; ?>
" />
                                </a>
                            <?php endif; ?>
                            <?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['description']; ?>

                        </p>

                        <p class="section">
                            <?php if ($this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['discounted_price'] != 0): ?>
                                <span class="old-price"><?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['price']; ?>
</span>
                                <span class="price"><?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['discounted_price']; ?>
</span>
                                <?php else: ?>
                                <span class="price"><?php echo $this->_tpl_vars['obj']->mProducts[$this->_sections['k']['index']]['price']; ?>
</span>
                            <?php endif; ?>
                        </p>
                    </td>
                    <?php if ($this->_sections['k']['index'] % 2 != 0 && ! $this->_sections['k']['first'] || $this->_sections['k']['last']): ?>
                        </tr>
                    <?php endif; ?>
        <?php endfor; endif; ?>
    </tbody>
    </table>
<?php endif; ?>