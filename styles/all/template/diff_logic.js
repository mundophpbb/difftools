(function($) {
    'use strict';

    $(function() {
        // Abrir Modal e Overlay
        $(document).on('click', '.bbcode-dif-wizard', function(e) {
            e.preventDefault();
            $('#diff-wizard-overlay, #diff-wizard-modal').fadeIn(200);
        });

        // Fechar ao clicar no cancelar ou no fundo escuro
        $(document).on('click', '#close-diff-wizard, #diff-wizard-overlay', function(e) {
            e.preventDefault();
            $('#diff-wizard-overlay, #diff-wizard-modal').fadeOut(200);
        });

        // Lógica de Geração: Foco em "Copiar e Colar" limpo
        $(document).on('click', '#generate-diff', function(e) {
            e.preventDefault();
            
            const oldLines = $('#diff-old').val().split('\n');
            const newLines = $('#diff-new').val().split('\n');
            let result = '[dif]\n';
            
            let oldIdx = 0;
            let newIdx = 0;

            while (oldIdx < oldLines.length || newIdx < newLines.length) {
                const oldLine = oldLines[oldIdx];
                const newLine = newLines[newIdx];

                if (oldLine === newLine) {
                    if (oldLine !== undefined) {
                        // Linha igual: Espaço em branco no início (neutro)
                        result += '  ' + oldLine + '\n';
                    }
                    oldIdx++;
                    newIdx++;
                } 
                else if (oldLine !== undefined && !newLines.includes(oldLine, newIdx)) {
                    // LINHA REMOVIDA: Sinal "-" no início para cor vermelha
                    result += '-' + oldLine + '\n';
                    oldIdx++;
                } 
                else if (newLine !== undefined) {
                    // LINHA NOVA: Sinal "+" no início para cor verde
                    result += '+' + newLine + '\n';
                    newIdx++;
                } else {
                    oldIdx++;
                    newIdx++;
                }
            }

            result += '[/dif]';

            // Insere no editor e limpa o modal
            $('#message').val($('#message').val() + result);
            $('#diff-wizard-overlay, #diff-wizard-modal').fadeOut(200);
            $('#diff-old, #diff-new').val('');
        });
    });
})(jQuery);