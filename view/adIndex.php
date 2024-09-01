<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>管理员页面</title>
	<link rel="stylesheet" href="../static/pkg/bootstrap4.6.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../static/css/adindex.css">
	<script src="../static/pkg/jquery3.7.0/jquery-3.7.0.min.js"></script>
	<style>
		/* 使得按钮居中 */
		.custom-button-container {
			display: flex;
			align-items: center;
		}

		.disabled-link {
			color: #888;
			/* 设置链接颜色为灰色 */
			pointer-events: none;
			/* 禁用点击事件 */
			cursor: not-allowed;
			/* 显示禁用状态的鼠标光标 */
		}
	</style>

	<!-- 使得当前页面的超链接变灰 -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// 获取当前页面的URL
			var currentUrl = window.location.href;

			// 获取导航链接的<a>元素
			var userLink = document.querySelector("a[href='./adIndex.php']");
			var postLink = document.querySelector("a[href='./adpublish.php']");

			// 检测是否为用户信息页，并添加或删除 "disabled-link" 类
			if (currentUrl.includes("adIndex.php")) {
				userLink.classList.add("disabled-link");
			} else {
				userLink.classList.remove("disabled-link");
			}

			// 检测是否为帖子信息页，并添加或删除 "disabled-link" 类
			if (currentUrl.includes("adpublish.php")) {
				postLink.classList.add("disabled-link");
			} else {
				postLink.classList.remove("disabled-link");
			}
		});
	</script>
</head>

<body>
	<ul class="nav justify-content-center">
		<li class="nav-item">
			<a class="nav-link active disabled" href="#">
				<?php
				include_once "../models/conn.php";
				if (isset($_SESSION['account'])) {
					echo "当前操作员：" . $_SESSION['account'];
				} else {
					echo "<script>location.href='./adlogin.html'</script>";
				}


				?>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="./adlogout.php">退出</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="./adIndex.php">用户信息页</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="./adpublish.php">帖子信息页</a>
		</li>
		<li class="nav-item custom-button-container ml-auto">
		    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAnnouncement">
		        公告
		    </button>
		</li>&nbsp;&nbsp;&nbsp;
		<li class="nav-item custom-button-container "><!-- 使用 ml-auto 类尽可能使其他元素向左对齐-->
			<button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#ModalUnban">
				恢复用户
			</button>
		</li>
		&nbsp;&nbsp;&nbsp;
		<li class="nav-item custom-button-container ">
			<button type="button" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#ModalBan">
				封禁用户
			</button>
		</li>
	</ul>

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">用户名</th>
				<th scope="col">密码</th>
				<th scope="col">昵称</th>
				<th scope="col">头像路径</th>
				<th scope="col">联系方式</th>
				<th scope="col">状态</th>
				<th scope="col">修改</th>
				<th scope="col">删除</th>
			</tr>
		</thead>
		<tbody id="userList">
			<!-- <tr>
			<th scope="row">1</th>
			<td>Mark</td>
			<td>Otto</td>
			<td>@mdo</td>
		  </tr> -->

		</tbody>
	</table>

	<div class="container"> <!-- 布局  留白 80%填充 --> <!-- container-fluid 100%填充 -->
		<script src="../static/pkg/popper/popper.min.js"></script>
		<script>
			fetch('../aips/getuserList.php', {
					method: 'GET',
					mode: 'cors', //允许发送跨域请求
					Credentials: 'include' //证书
				})
				.then(reponse => {
					return reponse.json()
				})
				.then(data => {
					let userList = document.querySelector("#userList");
					data.forEach(v => {
						let buttonData = [v[0], v[1], v[2], v[3], v[4], v[5]]; // 创建包含 v[0] 到 v[5] 的数组

						if (v[4] == 1) {
							banned = "已封禁";
							userList.innerHTML += `
							<tr>
								<th scope="row">${v[0]}</th>
								<td>${v[1]}</td>
								<td>${v[2]}</td>
								<td>${v[3]}</td>
								<td>${v[5]}</td>
								<td style="color: red;">${banned}</td>
								<td><button data-info='${JSON.stringify(buttonData)}' type="button" class="btn btn-info btn-details" data-toggle="modal" data-target="#ModalPersonedit"></button></td>
								<td><button id="${v[0]}" type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#ModalPersondelete"></button></td>
							</tr>`;
									//转换为JSON字符串
						} else {
							banned = "正常";
							userList.innerHTML += `
							<tr>
								<th scope="row">${v[0]}</th>
								<td>${v[1]}</td>
								<td>${v[2]}</td>
								<td>${v[3]}</td>
								<td>${v[5]}</td>
								<td>${banned}</td>
								<td><button data-info='${JSON.stringify(buttonData)}' type="button" class="btn btn-info btn-details" data-toggle="modal" data-target="#ModalPersonedit"></button></td>
								<td><button id="${v[0]}" type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#ModalPersondelete"></button></td>
							</tr>`;
						}
					});
					// JSON是一种用于数据交换的文本格式
					//绑定删除按钮和用户名  以及修改按钮
					let delete_buttons = document.querySelectorAll(".btn-delete");
					delete_buttons.forEach(button => {
						button.addEventListener("click", function() {
							let unameInput = document.querySelector("#uname");
							unameInput.value = this.id;
							console.log(this.id)
							console.log(pubIdInput);
						});
					});
					let edit_buttons = document.querySelectorAll(".btn-details");

					edit_buttons.forEach(button => {
						button.addEventListener("click", function() {
							let urnameInput = document.querySelector("#urname");//隐藏的，不会被修改
							let unameInput = document.querySelector("#uname2");
							let passwordInput = document.querySelector("#password");
							let nicknameInput = document.querySelector("#nickname");
							let contactInput = document.querySelector("#contact");
							// 获取按钮上存储的数据（通过 data-info 属性）
							let buttonDataString = this.getAttribute("data-info");
							let buttonData = JSON.parse(buttonDataString);//将该 JSON 字符串解析为一个 JavaScript 对象

							urnameInput.value = buttonData[0];
							unameInput.value = buttonData[0];
							passwordInput.value = buttonData[1];
							nicknameInput.value = buttonData[2];
							contactInput.value = buttonData[5];
						});
					});
				});
		</script>
	</div>
	
	<!-- 发布公告 -->
	<div class="modal fade" id="ModalAnnouncement" tabindex="-1" aria-labelledby="announcementLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" action="/controls/announcement.php">
				<div class="modal-content">
					<div class="modal-header bg-primary text-white">
						<h5 class="modal-title" id="announcementLabel">发布公告</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="announcement" class="form-label">公告内容：</label>
							<textarea class="form-control" name="announcement" rows="4"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
						<input type="submit" class="btn btn-primary" name="submit" value="发布">
					</div>
				</div>
			</form>
		</div>
	</div>


	<!-- 封禁用户 -->
	<div class="modal fade" id="ModalBan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" action="/controls/ban.php">
				<div class="modal-content">
					<div class="modal-header bg-warning text-white">
						<h5 class="modal-title" id="exampleModalLabel">封禁用户</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="username" class="form-label">用户名：</label>
							<input class="form-control" name="username" type="text" />
							<input name="isban" type="hidden" value="1" />
						</div>
						<p class="text-secondary" style="font-size: smaller;">被封禁用户无法发帖或回复！</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
						<input type="submit" class="btn btn-warning" name="submit" value="提交">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- 恢复用户 -->
	<div class="modal fade" id="ModalUnban" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" action="/controls/ban.php">
				<div class="modal-content">
					<div class="modal-header bg-success text-white">
						<h5 class="modal-title" id="exampleModalLabel">恢复用户</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="username" class="form-label">用户名：</label>
							<input class="form-control" name="username" type="text" />
							<input name="isban" type="hidden" value="0" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
						<input type="submit" class="btn btn-success" name="submit" value="提交">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- 删除用户 -->
	<div class="modal fade" id="ModalPersondelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="get" action="/controls/userdelete.php">
				<div class="modal-content">
					<div class="modal-header bg-danger text-white">
						<h5 class="modal-title" id="exampleModalLabel">删除用户</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>确定要删除该用户吗？</p>
						<input type="hidden" name="uname" id="uname" value="">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
						<input type="submit" class="btn btn-danger" name="submit" value="确定">
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Modal 修改用户信息-->
	<div class="modal fade" id="ModalPersonedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/controls/personInfoEdit.php">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">修改用户信息</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="urname" id="urname" value="">
                        <div class="mb-3">
                            <label for="uname2" class="form-label">用户名：</label>
                            <input type="text" class="form-control" name="uname2" id="uname2" value="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密码：</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                        <div class="mb-3">
                            <label for="nickname" class="form-label">昵称：</label>
                            <input type="text" class="form-control" name="nickname" id="nickname" value="">
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">联系方式：</label>
                            <input type="text" class="form-control" name="contact" id="contact" value="">
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
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="../static/pkg/popper/popper.min.js"></script>
	<script src="../static/pkg/bootstrap4.6.1/js/bootstrap.min.js"></script>
	<script src="../static/pkg/js-cookie/js.cookie.min.js"></script>
	<script src="/static/pkg/bootstrap4.6.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>