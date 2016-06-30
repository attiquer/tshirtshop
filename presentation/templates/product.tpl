{* product.tpl *}
{load_presentation_object filename="product" assign="obj"}
<h1 class="title">{$obj->mProduct.name}</h1>
{if $obj->mProduct.image}
    <img src="{$obj->mProduct.image}" class="product-image" />
{/if}
{if $obj->mProduct.image_2}
    <img src="{$obj->mProduct.image_2}" class="product-image" />
{/if}
<p class="description">
    {$obj->mProduct.description}
</p>
<p class="section">
    Price:
    {if $obj->mProduct.discounted_price != 0}
        <span class="old-price">{$obj->mProduct.price}</span>
        <span class="price">{$obj->mProduct.discounted_price}</span>
        {else}
        <span class="price">{$obj->mProduct.discounted_price}</span>
    {/if}

    {if $obj->mLinkTocontinueShopping}
        <a href="{$obj->mLinkTocontinueShopping}">Continue Shopping</a>
    {/if}

    <h2>Find Similar Products</h2>
<ol>
    {section name=i loop=$obj->mLocations}
        <li class="navigation">
            {strip}
                <a href="{$obj->mLocations[i].link_to_department}">{$obj->mLocations[i].department_name}</a>
            {/strip}
            &raquo;
            {strip}
                <a href="{$obj->mLocations[i].link_to_category}">{$obj->mLocations[i].category_name}</a>
            {/strip}
        </li>
    {/section}
</ol>
</p>