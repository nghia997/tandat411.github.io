- Thêm virtual host vào file: C:\xampp\apache\conf\extra\httpd-vhosts.conf
============================================
<VirtualHost domain1.com:80>
    DocumentRoot "C:\xampp\htdocs\tandat411.github.io\Task PHP\Week-2\SessionDB-Exercise\domain1"
    ServerName domain1.com
</VirtualHost>

<VirtualHost domain2.com:80>
    DocumentRoot "C:\xampp\htdocs\tandat411.github.io\Task PHP\Week-2\SessionDB-Exercise\domain2"
    ServerName domain2.com
</VirtualHost>
============================================

- Thêm khai báo domain vừa tạo ở file host trong mục: C:\Windows\System32\drivers\etc
============================================
127.0.0.1 domain1.com
127.0.0.1 domain2.com
============================================