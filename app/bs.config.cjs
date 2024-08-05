module.exports = {
  proxy: "http://localhost:80",  // O Apache está rodando na porta 80
  port: 3001,  // Porta que o BrowserSync vai utilizar
  files: [
    "src/**/*.{php,html,css,js}",  // Monitora mudanças nesses arquivos
    "public/**/*.{php,html,css,js}"
  ],
  reloadDelay: 500,
  open: false,  // Não abrir automaticamente o navegador
  ui: false,  // Desabilitar a interface de usuário do BrowserSync
  notify: false,  // Desabilitar notificações do BrowserSync
  ghostMode: false,  // Desabilitar sincronização de cliques, rolagem, etc.
  online: false,  // Desabilitar verificação de conexão online
};
