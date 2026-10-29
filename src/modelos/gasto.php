<?php

function createExpense(PDO $pdo, string $payerEmail, string $concept, string $amount): bool
{
    $sql = 'INSERT INTO Expenses (payer_email,concept,amount)
            VALUES (:payer,:concept,:amount)';

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':payer' => $payerEmail,
            ':concept' => $concept,
            ':amount' => $amount,
        ]);
        return true;
    } catch (PDOException $e){
        error_log('createExpense: ' . $e->getMessage());
        return false;
    }
}

function getActiveExpenses(PDO $pdo): array
{
    $sql = 'SELECT e.id, e.payer_email, u.nickname, e.concept, e.amount, e.registration_date
            FROM Expenses e
            JOIN Users u ON u.email = e.payer_email
            WHERE e.is_settled = 0
            ORDER BY e.registration_date DESC, e.id DESC';

    try{
        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        error_log('getActiveExpenses: ' . $e->getMessage());
        return [];
    }
}

function deleteExpense(PDO $pdo, int $id): bool
{
    $sql = 'DELETE FROM Expenses WHERE id = :id AND is_settled = 0';
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() === 1;
    } catch (PDOException $e){
        error_log('deleteExpense: ' . $e->getMessage());
        return false;
    }
}