<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Explorer</title>
</head>
<style>
    .dir_color {
        color: blue;
    }

    .dir_color:hover {
        color: #7a7afa;
        cursor: pointer;
    }

    .link_color {
        color: green;
    }

    .link_color:hover {
        color: #86ff86;
        cursor: pointer;
    }
</style>
<body>
<?php var_dump($driver['name']);?>
<select id="drivers">
    <? foreach ($drives as $drive): ?>
        <option <?= $drive == $driver['name'] ? 'selected' : '' ?>><?= $drive ?></option>
    <? endforeach; ?>
</select>
<?= $driver['total'] ?>|
<?= $driver['free'] ?>
<table>
    <tr>
        <td>name</td>
        <td>type</td>
        <td>memory</td>
        <td>created</td>
        <td>modified</td>
    </tr>
    <?php foreach ($files as $file): ?>
        <tr class="<?= $file['type'] ?>_color js_target" data-target="<?= $file['target'] ?>">
            <td title="<?= $file['name'] ?>"><?= $file['short'] ?></td>
            <td><?= $file['type'] ?></td>
            <td><?= $file['memory'] ?></td>
            <td><?= $file['created'] ?></td>
            <td><?= $file['modified'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<form action="/" method="get" id="form">
    <input type="hidden" name="target" id="target">
</form>
<script>
    let selectElem = document.getElementById('drivers').addEventListener('change', () => {
        console.log(event.target);
        // document.getElementById('target').value = el.dataset['target'];
        // document.getElementById('form').submit();
    });
    document.querySelectorAll('.js_target').forEach(el => {
        el.addEventListener('click', () => {
            document.getElementById('target').value = el.dataset['target'];
            document.getElementById('form').submit();
        });
    });
</script>
</body>
</html>

