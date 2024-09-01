const Person = {
    func: {
        init: function () {
            username = document.querySelector('#username');
            username.value = Cookies.get("username");//方法
            Person.func.getAvatar();
            // 点击主页时刷新页面同时保持token和username
            home = document.querySelector('#home');
            home.href = "/controls/urindex.php?username=" + username.value ;
        },
        //获取URL参数
        getQueryVariable: function (variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) { return pair[1]; }
            }
            return (false);
        },
        //模态框表示
        uploadAvatar: function () {
            $('#ModalUploadAvatar').modal({          //document.querySelector("#ModalUploadAvatar").modal();
                show: true
            })
        },
        //得到头像路径 切换头像   ?Cookies.get('username')可以吗 原来是ff
        getAvatar: function () {
            console.log(Cookies.get("username"))
            axios.get("/controls/getAvatar.php?username=" + Cookies.get("username")).then(function (res) {  //这里将php中$_get的值设为ff
                //username=ff后面没有引号！！！！
                console.log(res)
                let avatar = document.querySelector("#avatar")
                avatar.src = res.data.avatar
            })
        },
        //每次点击都会调用，因此不放在init里面
        compressor: function (e) {
            const file = e.target.files[0];

            if (!file) {
                return;
            }

            new Compressor(file, {
                quality: 0.6, //压缩比

                success(result) {
                console.log(result)
                Person.func.blobToBase64(result).then(res=>{
                    //转化后的BASE64
                    document.querySelector("#avatarPreview").src=res
                    console.log('base64',res)
                })
                
                // const formData = new FormData();

                // // The third parameter is required for server
                // formData.append('file', result, result.name);

                // // Send the compressed image file to server with XMLHttpRequest.
                // axios.post('/path/to/upload', formData).then(() => {
                //     console.log('Upload success');
                // });
                },
                error(err) {
                    console.log(err.message);
                },
            });

        },
        //2进制转化为64进制提供给前端
        blobToBase64: function(blob) {
            return new Promise((resolve, reject) => {
              const fileReader = new FileReader();
              fileReader.onload = (e) => {
                resolve(e.target.result);
              };
              fileReader.readAsDataURL(blob);
              fileReader.onerror = () => {
                reject(new Error('blobToBase64 error'));
              };
            });
          }
          
    }
}
