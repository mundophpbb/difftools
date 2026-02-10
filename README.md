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
    <div class="diff-engine" style="font-family: ui-monospace, SFMono-Regular, SF Mono, Menlo, Consolas, monospace; font-size: 12px; line-height: 20px;">{TEXT}</div>
</div>

<script>
// <![CDATA[
(function() {
    var targets = document.querySelectorAll('.diff-engine:not(.done)');
    targets.forEach(function(el) {
        // Normalizes line breaks from the editor
        var raw = el.innerHTML.replace(/<br\s*\/?>/gi, '\n');

        // Ensures "+" or "-" signs trigger new lines if they are on the same line
        if (raw.indexOf('\n') === -1) {
            raw = raw.replace(/\s(\+|\-)/g, '\n$1'); 
        } 

        var lines = raw.split('\n'); 
        var html = ''; 

        lines.forEach(function(line) { 
            var clean = line.replace(/<[^>]*>/g, '').trim(); 
            
            if (clean.indexOf('+') === 0) { 
                // GitHub Addition (Green)
                html += '<div style="background-color: #dafbe1; color: #1a7f37; padding: 0 12px; border-bottom: 1px solid #dcefe1;">' + line + '</div>'; 
            } else if (clean.indexOf('-') === 0) { 
                // GitHub Deletion (Red)
                html += '<div style="background-color: #ffebe9; color: #cf222e; padding: 0 12px; border-bottom: 1px solid #ffd3d0;">' + line + '</div>'; 
            } else if (clean.length > 0) { 
                // Neutral Line
                html += '<div style="padding: 0 12px; background: #fff;">' + line + '</div>'; 
            } 
        }); 

        el.innerHTML = html; 
        el.className += ' done'; 
    });
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
