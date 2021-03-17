<?php
require_once "assets/fpdf/fpdf.php";
require_once "assets/connect/pdo.php";

class myPDF extends FPDF
{
  function headerN()
  {
    $this->Image('assets/images/LuExamHiveLogo.png', 20, 6, 15, 15);
    $this->SetFont('Arial', '', 16);
    $this->Cell(276, 5, 'LU Exam Hive', 0, 0, 'C');
    $this->Ln();
    $this->SetFont('Times', '', 12);
    $this->Cell(276, 5, 'Result Sheet', 0, 0, 'C');
    $this->Ln();
  }
  function questionInfo($pdo)
  {
    $q_id = $_GET['Question_Description_ID'];
    $sql = $pdo->prepare("SELECT question_description.Question_Description_ID, question_description.Teacher_ID, question_description.Course_Code,  question_description.Batch ,question_description.Section, question_description.Course_Name, question_description.Title, teacher.Name FROM question_description INNER JOIN teacher ON question_description.Teacher_ID = teacher.Teacher_ID WHERE Question_Description_ID = $q_id");
    $sql->setFetchMode(PDO::FETCH_OBJ);
    $sql->execute();
    $row = $sql->fetch();

    $this->SetFont('Times', '', 12);
    $this->Cell(276, 5, $row->Title, 0, 0, 'C');
    $this->Ln();
    $this->Cell(276, 5, "Course Title: " . $row->Course_Name, 0, 0, 'C');
    $this->Ln();
    $this->Cell(276, 5, "Course Code: " . $row->Course_Code, 0, 0, 'C');
    $this->Ln();
    $this->Cell(276, 5, "Batch(Sec): " . $row->Batch ."(".$row->Section.")", 0, 0, 'C');
    $this->Ln(20);
  }
  function footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial', '', 8);
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}');
  }

  function headerTable()
  {
    $this->SetFont('Times', 'B', 14);
    $this->SetLeftMargin(65);
    $this->Cell(45, 10, 'Student ID', 1, 0, 'C');
    $this->Cell(90, 10, 'Name', 1, 0, 'C');
    $this->Cell(30, 10, 'Score', 1, 0, 'C');
    $this->Ln();
  }
  function viewTable($pdo)
  {
    $this->SetFont('Times', '', 12);
    $this->SetLeftMargin(65);
    $q_id = $_GET['Question_Description_ID'];
    $stmt = $pdo->query("SELECT DISTINCT quiz_answer.Student_ID, quiz_answer.Full_Name, quiz_answer.Score, quiz_question.Question_Description_ID FROM quiz_answer INNER JOIN quiz_question ON quiz_question.ID = quiz_answer.Last_ID WHERE quiz_question.Question_Description_ID = '$q_id' ORDER BY Student_ID ASC");
    while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->Cell(45, 10, $data->Student_ID, 1, 0, 'C');
      $this->Cell(90, 10, $data->Full_Name, 1, 0, 'C');
      $this->Cell(30, 10, $data->Score, 1, 0, 'C');
      $this->Ln();
    }
  }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerN();
$pdf->questionInfo($pdo);
$pdf->headerTable();
$pdf->viewTable($pdo);
$pdf->Output();
