<?php

$surname_lama = $_POST['surname'] ?? '';
$email_lama = $_POST['email'] ?? '';
$alamat_lama = $_POST['street_address'] ?? '';
$state_lama = $_POST['state'] ?? '';
$gender_lama = $_POST['gender'] ?? '';
$vegetarian_lama = isset($_POST['vegetarian']);
?>
<form action="form.php" method="POST">
    <p>
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname"
               value="<?php echo htmlspecialchars($surname_lama); ?>">
    </p>

    <p>
        <label for="email">Email address:</label><br>
        <input type="email" id="email" name="email"
               value="<?php echo htmlspecialchars($email_lama); ?>">
    </p>

    <p>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password">
    </p>

    <p>
        <label for="street_address">Street Address:</label><br>
        <textarea id="street_address" name="street_address" rows="4" cols="35"><?php
            echo htmlspecialchars($alamat_lama);
        ?></textarea>
    </p>

    <p>
        <label for="state">State:</label><br>
        <select id="state" name="state">
            <option value="">-- Pilih state --</option>
            <?php
            $pilihan_state = array(
                'NSW' => 'New South Wales',
                'VIC' => 'Victoria',
                'QLD' => 'Queensland',
                'WA' => 'Western Australia',
                'SA' => 'South Australia',
                'TAS' => 'Tasmania',
                'ACT' => 'Australian Capital Territory',
                'NT' => 'Northern Territory'
            );

            foreach ($pilihan_state as $kode_state => $nama_state) {
                $terpilih = ($state_lama === $kode_state) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($kode_state) . '" '
                    . $terpilih . '>' . htmlspecialchars($nama_state) . '</option>';
            }
            ?>
        </select>
    </p>

    <input type="hidden" name="country" value="Australia">

    <p>Gender:</p>
    <label>
        <input type="radio" name="gender" value="Male"
            <?php echo ($gender_lama === 'Male') ? 'checked' : ''; ?>> Male
    </label>
    <label>
        <input type="radio" name="gender" value="Female"
            <?php echo ($gender_lama === 'Female') ? 'checked' : ''; ?>> Female
    </label>
    <label>
        <input type="radio" name="gender" value="Other"
            <?php echo ($gender_lama === 'Other') ? 'checked' : ''; ?>> Other
    </label>

    <p>
        <label>
            <input type="checkbox" name="vegetarian" value="Yes"
                <?php echo $vegetarian_lama ? 'checked' : ''; ?>>
            Vegetarian?
        </label>
    </p>

    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>
