# difftools

## 🛠️ Custom BBCode Configuration

To use this extension correctly, you must create a custom BBCode in your phpBB **Administration Control Panel (ACP)**.

### 1. BBCode Usage

```bbcode
[dif]{TEXT}[/dif]

```

### 2. HTML Replacement

```html
<div class="gh-diff-box" style="background-color: #ffffff; color: #24292f; border: 1px solid #d0d7de; border-radius: 6px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif; overflow: hidden; margin: 10px 0;"> 
    <div style="background-color: #f6f8fa; padding: 8px 12px; font-size: 12px; border-bottom: 1px solid #d0d7de; color: #57606a; font-weight: 600;"> 
        Diff Comparison 
    </div> 
    <pre class="diff-engine" style="margin:0; font-family: ui-monospace, SFMono-Regular, SF Mono, Menlo, Consolas, monospace; font-size: 12px; line-height: 20px; white-space: pre-wrap; word-break: break-all;">{TEXT}</pre>
</div>

<script>
// <![CDATA[
(function() {
    var targets = document.querySelectorAll('.diff-engine:not(.done)');
    targets.forEach(function(el) {
        // USAMOS textContent para pegar o código puro, ignorando tags HTML do phpBB
        var raw = el.textContent; 
        var lines = raw.split('\n'); 
        var html = ''; 

        lines.forEach(function(line) { 
            // Remove espaços extras apenas para checar o sinal
            var check = line.trim(); 
            
            if (check.indexOf('+') === 0) { 
                html += '<div style="background-color: #dafbe1; color: #1a7f37; padding: 0 12px; border-bottom: 1px solid #dcefe1;">' + escapeHtml(line) + '</div>'; 
            } else if (check.indexOf('-') === 0) { 
                html += '<div style="background-color: #ffebe9; color: #cf222e; padding: 0 12px; border-bottom: 1px solid #ffd3d0;">' + escapeHtml(line) + '</div>'; 
            } else if (line.length > 0) { 
                html += '<div style="padding: 0 12px; background: #fff;">' + escapeHtml(line) + '</div>'; 
            } 
        }); 

        el.innerHTML = html; 
        el.className += ' done'; 
    });

    // Função auxiliar para evitar que tags < > quebrem o layout
    function escapeHtml(text) {
        var map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'};
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
})();
// ]]>
</script>

```

### 3. Help Line

```text
[dif]Code for comparison[/dif]

```

### 4. Settings

* **Display on posting page:** No (the extension provides its own wizard button).
