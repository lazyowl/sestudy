  <div id="content" class="main box container-fluid">
    <div class="row-fluid">
      <div id="sidecontent" class="span3">
        <div id="sidebar">
          <ul class="nav nav-list">
            <li class="nav-header">导航</li>
            <li><a href="<?=site_url()?>intro.html">课程介绍</a></li>
            <li><a href="<?=site_url()?>outline.html">课程大纲</a></li>
            <li><a href="<?=site_url()?>tinfo.html">教师介绍</a></li>
            <li class="divider"></li>
            <li class="active"><a href="<?=site_url()?>notice.html">课程通知</a></li>
            <li><a href="<?=site_url()?>slide.html">课件下载</a></li>
            <li><a href="<?=site_url()?>resource.html">资料下载</a></li>
            <li><a href="<?=site_url()?>share.html">共享资料</a></li>
            <li><a href="<?=site_url()?>assignment.html">作业提交</a></li>
            <li><a href="<?=site_url()?>forum.html">课程讨论区</a></li>
        </div> <!-- sidebar -->
      </div> <!-- sidecontent -->

      <div id="maincontent" class="span9">

        <h3>课程通知：</h3>  
        <form class="form-search" method="post" action="<?=site_url()?>notice/search.html">
          <table>
            <tr>
              <td width="92%">
                <div class="input-append">
                  <input type="text" id="search" name="search" class="input-large search-query" placeholder="标题关键字">
                  <input type="submit" class="btn btn-info" value="搜索">
                </div>
              </td>
              <td>                
                <div>
                  <a class="btn btn-primary" href="<?=site_url()?>notice/allnotice.html">更多</a>
                </div>
              </td>
            </tr>
          </table>
        </form>

        <hr>

        <table class="table table-hover" style="border-left: 1px solid #dddddd;border-right: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-collapse: separate;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
        
        <?php $i = 1; ?>
        <?php foreach ($results->result() as $row): ?>

        <?php if ($i % 2 == 1): ?>
          <tr class="info">
        <?php endif; ?>
        <?php if ($i % 2 == 0): ?>
          <tr>
        <?php endif; ?>
        
            <td width="13%">&nbsp;&nbsp;[<?=$row->username?>]</td>
            <td width="70%">
              <a href="<?=site_url()?>notice/view/<?=$row->nid?>.html"><?=$this->notice_model->get_title($row->title)?></a>
            </td>
            <td><?=$row->date?></td>
          </tr>

        <?php $i++; ?>
        <?php endforeach; ?><!-- the end of the foreach cycle -->

        </table><!-- the news table -->
        
      </div> <!-- main content -->
    </div> <!-- row-fluid -->
  </div> <!-- content -->
