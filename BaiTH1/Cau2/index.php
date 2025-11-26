<?php
$data_file = 'quiz.txt';
$quiz_questions = [];


function parseQuizData($file_path) {
    if (!file_exists($file_path)) {
        return [];
    }
    $content = file_get_contents($file_path);
    $blocks = preg_split('/\n\s*\n/', trim($content));
    $questions = [];
    
    foreach ($blocks as $block) {
        $lines = array_filter(explode("\n", trim($block)));
        if (count($lines) < 3) continue;

        $question_text = array_shift($lines);
        $options = [];
        $answer_str = ''; 

        foreach ($lines as $line) {
            $line = trim($line);
            if (strpos($line, 'ANSWER:') === 0) {
                $answer_str = trim(substr($line, strlen('ANSWER:')));
                break;
            } else {
                $options[] = $line;
            }
        }

        if ($question_text && count($options) > 0 && $answer_str) {
            $correct_answers = array_map('trim', explode(',', strtoupper($answer_str)));

            $questions[] = [
                'question' => $question_text,
                'options' => $options,
                'answer' => $correct_answers 
            ];
        }
    }
    return $questions;
}

$quiz_questions = parseQuizData($data_file);


$submitted_index = $_POST['question_index'] ?? null;
$user_choices = $_POST['user_choice'] ?? []; 
$feedback = ['index' => null, 'html' => ''];

if ($submitted_index !== null && isset($quiz_questions[$submitted_index])) {
    $submitted_index = (int)$submitted_index;
    $q = $quiz_questions[$submitted_index];
    
    $correct_answers = $q['answer'];
    $user_choices = array_map('strtoupper', (array)$user_choices); 

    $is_correct = (count($user_choices) === count($correct_answers)) && 
                  (empty(array_diff($user_choices, $correct_answers)));

    $feedback['index'] = $submitted_index;
    
    if ($is_correct) {
        $feedback['html'] = "<p><b> Chính xác!</b> Bạn đã chọn đúng.</p>";
    } else {
        $correct_option_texts = [];
        foreach ($correct_answers as $ans_char) {
            foreach ($q['options'] as $opt) {
                if (substr(trim($opt), 0, 1) === $ans_char) {
                    $correct_option_texts[] = htmlspecialchars($opt);
                    break;
                }
            }
        }
        $feedback['html'] = "<p><b>Sai rồi.</b> Đáp án đúng là: " . implode('; ', $correct_option_texts) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Thi Trắc Nghiệm Có Phản Hồi (index.php)</title>
</head>
<body>

    <h1>Bài Thi Trắc Nghiệm Android</h1>

    <?php foreach ($quiz_questions as $index => $q): 
        $is_submitted = ($feedback['index'] === $index);
        $user_choice_submitted = $is_submitted ? (array)$user_choices : [];
    ?>
        <div style="border: 1px solid black; padding: 10px; margin-bottom: 15px;">
            <p><b>Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($q['question']); ?></b></p>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="question_index" value="<?php echo $index; ?>">

                <div style="margin-top: 10px;">
                    <?php foreach ($q['options'] as $opt): 
                        $value = substr(trim($opt), 0, 1); 
                        $is_checked = in_array($value, $user_choice_submitted);
                    ?>
                        <label style="display: block;">
                            <input 
                                type="checkbox" 
                                name="user_choice[]" 
                                value="<?php echo htmlspecialchars($value); ?>" 
                                <?php echo $is_checked ? 'checked' : ''; ?>
                                <?php echo $is_submitted ? 'disabled' : ''; ?>
                            >
                            <?php echo htmlspecialchars($opt); ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <?php if (!$is_submitted): ?>
                    <button type="submit" style="margin-top: 10px;">Kiểm tra Đáp án</button>
                <?php else: ?>
                    <div style="padding: 8px; border: 1px solid gray; margin-top: 10px;">
                        <?php echo $feedback['html']; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    <?php endforeach; ?>

</body>
</html>