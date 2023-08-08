rodar todos os testes
```sh
vendor/bin/phpunit
or
php artisan test
```

rodar teste especifico
```sh
vendor/bin/phpunit --filter=nome_do_teste
```
      
criar teste unitario
```sh
php artisan make:test NomeTest --unit
```

## 
## Conceito dos 3 A(s)
- arrange (arranjo)
- act (ação)
- assert (AFIRMAR, o que eu espero dessa ação)

## 
## rodar job de envio de relatorio
```sh
php artisan schedule:work
```
