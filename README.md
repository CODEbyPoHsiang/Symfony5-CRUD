# Symfony5-CRUD
======================
## 還原步驟
1. CLONE 專案 :
```
   git clone https://github.com/CODEbyPoHsiang/Symfony5-CRUD
```
2. cd 進入專案資料夾
```
  cd Symfony5-CRUD
```
3. 安裝 composer 
```
  composer install
```
4.執行建立資料庫指令
```
php bin/console doctrine:database:create
```
5.執行還原資料表指令
```
php bin/console doctrine:migrations:migrate 
```
(由於此專案已經預先將migrations的資料表創建好，所以還原只須執行migrate即可)

6.啟動專案
```
php bin/console serve:run
```
7.Symfony 歡迎畫面
```
127.0.0.1:8000
```
8.專案主畫面 (專案名稱:Member)
```
127.0.0.1:8000/member
```
---
Symfony API 說明
---
在控制器中利用註解方式來定義路由
--

顯示全部資料 API (GET)
```
http://localhost/api
```
查看單一資料 API (GET)
```
http://localhost/api/{id}
```
新增一筆資料 API (POST)
```
http://localhost/api/new
```
編輯一筆資料 API (PUT)
```
http://localhost/api/edit/{id}
```
刪除一筆資料 API (DELETE)
```
http://localhost/api/delete/{id}
```
