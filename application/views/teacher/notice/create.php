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
            <li><a href="<?=site_url()?>account.html">学生账号管理</a></li>
            <li><a href="<?=site_url()?>group.html">学生分组</a></li>            
            <li class="divider"></li>
            <li><a href="<?=site_url()?>slide.html">课件上传</a></li>
            <li><a href="<?=site_url()?>resource.html">资料上传</a></li>
            <li><a href="<?=site_url()?>share.html">共享资料管理</a></li>
            <li class="divider"></li>
            <li class="active"><a href="<?=site_url()?>notice.html">消息发布</a></li>
            <li><a href="<?=site_url()?>assignment.html">作业管理</a></li>
            <li><a href="<?=site_url()?>forum.html">课程讨论区</a></li>
          </ul>
        </div> <!-- sidebar -->
      </div> <!-- sidecontent -->

      <div id="maincontent" class="span9">

        <form>
          <div><h3>消息标题：</h3></div>
          <input class="input-block-level" type="text" name="title" id="title">
          <div><h3>消息内容：</h3></div>
          <textarea id="detail" name="detail" style="width:100%;height:200px;"></textarea>
          <br>
          <div class="span3 offset8">
            <input type="checkbox" id="inhome" name="inhome" checked> 将本消息同步到主页中
          </div>
          <br><hr>
          <div class="span3 offset8">
            <button type="submit" class="btn btn-large">取消</button>
            <button type="submit" class="btn btn-large btn-primary">提交</button>
          </div>
        </form>
        
      </div> <!-- main content -->
    </div> <!-- row-fluid -->
  </div> <!-- content -->

<script type="text/javascript">
  var ue = UM.getEditor('detail');
</script>