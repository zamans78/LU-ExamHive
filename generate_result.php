<?php
require_once "assets/fpdf/fpdf.php";
require_once "assets/connect/pdo.php";

class myPDF extends FPDF
{
  function header()
  {
    $this->Image('assets/images/LuExamHiveLogo.png', 260, 6, 20, 20);
    $this->Image('assets/images/LUS.png', 20, 6, 20, 20);
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
    $this->SetLeftMargin(30);
    $this->Cell(40, 10, 'Student ID', 1, 0, 'C');
    $this->Cell(85, 10, 'Name', 1, 0, 'C');
    $this->Cell(40, 10, 'Batch(Sec)', 1, 0, 'C');
    $this->Cell(40, 10, 'Course Code', 1, 0, 'C');
    $this->Cell(30, 10, 'Score', 1, 0, 'C');
    $this->Ln();
  }
  function viewTable($pdo)
  {
    $this->SetFont('Times', '', 12);
    $this->SetLeftMargin(30);
    $q_id = $_GET['Question_Description_ID'];
    $stmt = $pdo->query("SELECT *, question_description.Course_Code FROM student_answer INNER JOIN question_description on question_description.Question_Description_ID = student_answer.Question_Description_ID WHERE student_answer.Question_Description_ID = $q_id");
    while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->Cell(40, 10, $data->Student_ID, 1, 0, 'C');
      $this->Cell(85, 10, $data->Full_Name, 1, 0, 'C');
      $this->Cell(40, 10, $data->Batch . "(" . $data->Section . ")", 1, 0, 'C');
      $this->Cell(40, 10, $data->Course_Code, 1, 0, 'C');
      $this->Cell(30, 10, $data->Score, 1, 0, 'C');
      $this->Ln();
    }
  }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->questionInfo($pdo);
$pdf->headerTable();
$pdf->viewTable($pdo);
$pdf->Output();
