1. 执行docker-compose up -d
1. 执行docker-compose exec app php artisan migrate
1. 执行docker-compose exec app php artisan db:seed 插入一条email为zsw@qq.com password为1234567的数据
1. 登录接口为127.0.0.1:8000/api/login  post请求
1. 获取用户信息接口为127.0.0.1:8000/api/profile     get请求
1. jwt认证为bearer token
