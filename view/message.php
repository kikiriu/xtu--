<?php
include '../models/conn.php';//累不开来session_start
// echo $_SESSION['username'];
// echo $_SESSION['userid'];
// echo session_id();
// echo session_save_path();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>校园失物招领系统</title>
    <link rel="stylesheet" href="../static/pkg/bootstrap4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/index.css">
    <script src="../static/pkg/jquery3.7.0/jquery-3.7.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../static/pkg/bootstrap4.6.1/js/bootstrap.min.js"></script>
    <script src="../static/pkg/popper/popper.min.js"></script>
    <script src="../static/js/index.js"></script>
    <script src="../static/pkg/js-cookie/js.cookie.min.js"></script>
    <script src="../static/pkg/compressor/compressor.min.js"></script>
    <!-- 压缩 -->
    <script src="../static/js/person.js"></script> <!-- 显示Modal -->
	<script>
	        $(document).ready(function () {
	            $("#systemRemindersTab").click(function () {
	                $("#systemReminders").removeClass("d-none");
	                $("#messages").addClass("d-none");
	                $("#systemRemindersTab").addClass("active");
	                $("#messagesTab").removeClass("active");
	            });
	
	            $("#messagesTab").click(function () {
					// alert($_SESSION['username']);
	                $("#messages").removeClass("d-none");
	                $("#systemReminders").addClass("d-none");
	                $("#messagesTab").addClass("active");
	                $("#systemRemindersTab").removeClass("active");
					//window.location.href ="http://localhost/webchat/index.php?v=webchat";
	            });
	        });
	    </script>
	<style>
        body {
            background-color: #f0f4f8; /* 淡灰蓝色背景 */
        }
        .content-wrapper {
            border: 2px solid black; /* 黑色边框 */
            padding: 15px;
            background-color: white; /* 白色背景 */
            width: 1000px; /* 固定宽度 */
            height: 600px; /* 固定高度 */
            overflow-y: auto; /* 当内容超过容器高度时，显示垂直滚动条 */
            overflow-x: hidden; /* 隐藏水平滚动条 */
            margin: 20px auto; /* 水平居中，顶部和底部有一些间距 */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加阴影 */
            border-radius: 10px; /* 圆角 */
        }
        .btn-group-toggle {
            margin-bottom: 15px;
        }
		
		 .btn-group-toggle .btn {
				font-size: 16px;
				font-weight: 500;
				border: 1px solid transparent;
			}

			.btn-group-toggle .btn.active {
				box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
			}

			.btn-primary {
				background-color: #007bff;
				border-color: #007bff;
			}

			.btn-primary:hover {
				background-color: #0056b3;
				border-color: #004085;
			}

			.btn-secondary {
				background-color: #6c757d;
				border-color: #6c757d;
			}

			.btn-secondary:hover {
				background-color: #5a6268;
				border-color: #545b62;
			}

			.btn-group-toggle .btn input[type="radio"] {
				display: none;
			}
			#deleteButton {
			    margin: 10px; /* 设置按钮与边界的距离 */
			}
			.btn-custom {
			    background-color: white; /* 设置按钮背景色为白色 */
			    color: black; /* 设置按钮文字颜色为黑色 */
			    border: 1px solid #007bff; /* 设置按钮边框颜色为蓝色或你希望的颜色 */
			}
			
			.btn-custom:hover {
			    background-color: #f8f9fa; /* 设置悬停时按钮背景色 */
			    color: black; /* 设置悬停时按钮文字颜色 */
			    border-color: #007bff; /* 设置悬停时按钮边框颜色 */
			}

    </style>
	
</head>

<body>
    <div class="header">
        <div class="h-main">
            <div class="titleAndimage">
                <a class="h-title" id="home" href="/controls/urindex.php?username=evil"> 校园失物招领
                   <img src="../static/assets/images/首页.png" alt="首页" width="30" height="30"></a>
            </div>
            <form action="/controls/search.php ?>" class="search" method="get">
                <input id="sea" name="search" autocomplete="off" placeholder="寻觅遗失的线索" type="text"
                    style="outline: none;">
                <button type="submit" style="border: none;">
                    <img src="../static/assets/images/搜索.png" alt="搜索" width="20" height="20">
                </button>
            </form>
            <div class="nav-user">
				<button type="button" class="btn btn-custom" id="messageButton">
				    查看消息
				</button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#ModalPublish">
                    我要发贴
                </button>&nbsp;&nbsp;&nbsp;
				<div class="nav">
				    <a href="/controls/logout.php" target="_parent">退出</a>
				</div>
				<img src="../static/assets/images/登出.png" alt="some_text" width="35" height="35">
				<script>
				        document.getElementById("messageButton").onclick = function() {
				            window.location.href = "../view/message.php";
				        };
				    </script>
            </div>
        </div>
    </div>
	<!-- Modal 发布帖子-->
	<div class="modal fade" id="ModalPublish" tabindex="-1" aria-labelledby="exampleModalLabel"
	    aria-hidden="true">
	    <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger modal -->
	        <form method="POST" action="/controls/publish_deal.php" enctype="multipart/form-data">
	            <div class="modal-content">
	                <div class="modal-header bg-primary text-white">
	                    <h5 class="modal-title" id="exampleModalLabel">发布帖子</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
	                        <label for="module_id">选择模块</label>
	                        <select class="form-control" name="module_id">
	                            <option>失物招领</option>
	                            <option>寻物启事</option>
	                            <option>其它</option>
	                        </select>
	                    </div>
	                    <div class="form-group">
	                        <label for="pub_title">标题</label>
	                        <input class="form-control" placeholder="请输入标题" name="pub_title" type="text" />
	                    </div>
	                    <div class="form-group">
	                        <label for="pub_content">内容</label>
	                        <textarea class="form-control" name="pub_content"
	                            style="height: 250px;"></textarea>
	                    </div>
	                    <div class="form-group">
	                        <label for="pub_image">上传图片</label>
	                        <input type="file" class="form-control-file" name="pub_image" accept="image/*">
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
	                    <input type="submit" class="btn btn-primary" name="submit" value="提交">
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
	<?php
	$username = $_COOKIE['username'];
	$banned="";
	// 查询用户的banned属性
	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result1 = $conn->query($sql);
	$row1 = $result1->fetch_assoc();
	
	$banned = $row1["banned"];
	if ($banned == 1) {
	    // 用户被封禁，显示封禁提示
	    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
	    echo '<strong>您已经被封禁!</strong>';
	    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>';
	    echo '</div>';
	}
	mysqli_free_result($result1);
	?>
	
  <div class="container content-wrapper">
		<div class="row">
		    <div class="col-md-12">
		        <div class="btn-group btn-group-toggle" data-toggle="buttons">
		            <label class="btn btn-primary rounded-pill mx-2 active" id="systemRemindersTab">
		                <input type="radio" name="options" id="option1" autocomplete="off" checked> 提醒
		            </label>
		            <label class="btn btn-secondary rounded-pill mx-2" id="messagesTab">
		                <input type="radio" name="options" id="option2" autocomplete="off"> 消息
		            </label>
					
		        </div>
		    </div>
		</div>
		<div class="row mt-3">
			<div class="col-md-12">
				<div id="systemReminders" class="content-section">
					<ul class="list-group">
						<!-- 从数据库获取系统提醒并显示 -->
						<?php
						// 查询系统提醒
						$username = $_COOKIE['username'];
						$sql = "SELECT message, pub_id, time FROM notifications WHERE username = '$username' OR username = 'root'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
						    while ($row = $result->fetch_assoc()) {
						        $message = htmlspecialchars($row['message']);
						        $pub_id = $row['pub_id'];
						        $time = date("Y-m-d H:i:s", strtotime($row['time'])); // 格式化时间
						
						        // 判断 pub_id 是否为 0
						        if ($pub_id == 0) {
						            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
						                    <div>
						                        <input type='checkbox' class='delete-checkbox' data-pub-id='$pub_id'>
						                        $message
						                    </div>
						                    <span>$time</span>
						                  </li>";
						        } else {
						            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
						                    <div>
						                        <input type='checkbox' class='delete-checkbox' data-pub-id='$pub_id'>
						                        <a href='https://localhost:/controls/detail.php?pub_id=$pub_id'>$message</a>
						                    </div>
						                    <span>$time</span>
						                  </li>";
						        }
						    }
						} else {
						    echo "<li class='list-group-item'>暂无系统提醒</li>";
						}
						?>
					</ul>
					<div class="d-flex justify-content-end align-items-end" style="height: 100%;">
					        <button id="deleteButton" class="btn btn-danger">删除</button>
					    </div>
				</div>
				<script>
				document.getElementById('deleteButton').addEventListener('click', function() {
				    let checkboxes = document.querySelectorAll('.delete-checkbox:checked');
				    let pubIds = [];
				    checkboxes.forEach(function(checkbox) {
				        pubIds.push(checkbox.getAttribute('data-pub-id'));
				    });
				
				    if (pubIds.length > 0) {
				        if (confirm('确定要删除选中的系统提醒吗？')) {
				            fetch('../controls/delete_notifications.php', {
				                method: 'POST',
				                headers: {
				                    'Content-Type': 'application/json'
				                },
				                body: JSON.stringify({ pub_ids: pubIds })
				            })
				            .then(response => response.json())
				            .then(data => {
				                if (data.success) {
				                    alert('删除成功');
				                    location.reload();
				                } else {
				                    alert('删除失败');
				                }
				            })
				            .catch(error => {
				                console.error('Error:', error);
				                alert('删除时发生错误');
				            });
				        }
				    } else {
				        alert('请选择要删除的系统提醒');
				    }
				});
				</script>
				
				
				<div id="messages" class="content-section d-none" style="display: flex; height: 70vh; flex-direction: row;">
    			    <div style="display: flex; flex-direction: column; flex: 1; border-right: 1px solid #ccc;">
    			        <div style="flex: 1; display: flex; flex-direction: column;">
    			            <iframe id = "contentFrame" src="http://localhost/webchat/index.php?v=content" style="border: none; width: 100%; height: 70%;"></iframe>
    			            <iframe id = "contentFrame_a" src="http://localhost/webchat/index.php?v=send" style="border: none; width: 100%; height: 30%;"></iframe>
    			        </div>
    			    </div>
    			    <div style="width: 300px; flex: 0 0 auto; border-left: 1px solid #ccc;">
    			        <iframe src="http://localhost/webchat/index.php?v=list" style="border: none; width: 100%; height: 100%;"></iframe>
    			    </div>
    			</div>	
				
			</div>
		</div>
	</div>
	

	
	
	
	<!-- 加载动画 -->
	<div id="mask">
	    <div id="loading" class="spinner-border text-info" role="status">
	    </div>
	    <p class="tiplo">Loading...</p>
	</div>
	
	
	<!-- 初始化  启动JS中部分函数 -->
	<script>Person.func.init();</script>
	<script src="/static/pkg/bootstrap4.6.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>