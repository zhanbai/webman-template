# <p align="center">[Webman Template](https://github.com/zhanbai/webman-template)</p>

## 关于

基于 PHP 高性能 HTTP 服务框架 [webman](https://github.com/walkor/webman) 的快速启动项目模板。

- 接口遵循 RESTful 软件设计风格
- 短信验证码功能
- 用户注册功能
- 用户登录功能
- JWT 令牌功能
- 命令生成 JWT 功能
- 获取用户信息功能
- 错误响应码功能

## 使用

```bash
# 克隆项目
$ git clone https://github.com/zhanbai/webman-template.git project-name

# 进入项目目录
$ cd project-name

# 安装依赖
$ composer install

# 创建并修改 .env 文件内容，主要是数据库信息
$ cp .env.example .env

# 执行数据库迁移
$ php vendor/bin/phinx migrate

# 启动服务
$ php webman start
```

浏览器访问 http://127.0.0.1:8787

# 手册

https://www.workerman.net/doc/webman

## 许可证

本项目开源，基于 [MIT 开源协议](https://opensource.org/licenses/MIT)。
