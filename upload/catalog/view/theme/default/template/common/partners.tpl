<?php echo $header; ?>

<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>

<?php echo $column_left; ?>
<?php echo $column_right; ?>

<style>
    .partners > div {
        overflow: auto;
        margin-bottom: 20px;
        padding: 0 15px;
        width: 290px;
        float: left;
    }
    .partners .image {
        margin-bottom: 20px;
        text-align: center;
    }
    .partners .name {
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
    }
    .partners .description {
        line-height: 15px;
        margin-bottom: 5px;
        color: #4D4D4D;
    }
</style>

<div id="content">
    <div class="partners">
        <?php foreach ($partners as $partner) { ?>
            <div>
                <div class="image">
                    <img src="<?php echo $partner['image']; ?>" title="<?php echo $partner['name']; ?>" alt="<?php echo $partner['name']; ?>" />
                </div>
                <div class="name">
                    <?php echo $partner['name']; ?>
                </div>
                <div class="description">
                    <?php echo $partner['description']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php echo $footer; ?>